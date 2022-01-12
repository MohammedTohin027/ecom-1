<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
// use Intervention\Image\Facades\Image;
// use Intervention\Image\ImageManagerStatic as Image;


class BrandController extends Controller
{
    //  view
    public function view(){
        $data['brands'] = Brand::orderBy('id', 'asc')->get();
        return view('admin.brand.view', $data);
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'brand_name_en' => 'required|unique:brands,brand_name_en',
            'brand_name_bn' => 'required|unique:brands,brand_name_bn',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'brand name english field is required !',
            'brand_name_bn.required' => 'brand name bangla field is required !',
            'brand_image.required' => 'brand image field is required !',
        ]);
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $image_ex = $image->getClientOriginalExtension();
            // $name_gen = octdec(uniqid()).dechex(uniqid()).'.'.$image_ex;
            $name_gen = date('YmdHi').'.'.$image_ex;
            // dd($name_gen);
            $save_url = 'upload/brands/'.$name_gen;
            // Image::configure(['driver' => 'imagick']);
            // Image::make($image)->resize(300,200)->save($save_url);
            Image::make($image)->resize(300, 200)->save($save_url);
        }
        else{
            $save_url = 'upload/avater.jpg';
        }
        Brand::create([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_name_bn' => $request->brand_name_bn,
            'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
            'brand_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Brand inserted Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //  edit
    public function edit($id){
        $data['brand'] = Brand::findOrFail($id);
        return view('admin.brand.edit', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'brand_name_en' => 'required|unique:brands,brand_name_en,'.$id,
            'brand_name_bn' => 'required|unique:brands,brand_name_bn,'.$id,
        ],[
            'brand_name_en.required' => 'brand name english field is required !',
            'brand_name_bn.required' => 'brand name bangla field is required !',
        ]);
        $brand = Brand::findOrFail($id);
        if ($request->hasFile('brand_image')) {
            if ($brand->brand_image != 'upload/avater.jpg') {
                unlink($brand->brand_image);
            }
            $image = $request->brand_image;
            $image_ex = $image->getClientOriginalExtension();
            $name_gen = octdec(uniqid()).dechex(uniqid()).'.'.$image_ex;
            $save_url = 'upload/brands/'.$name_gen;
            Image::make($image)->resize(300,200)->save($save_url);
        }
        else{
            $save_url = $brand->brand_image;
        }
        Brand::where('id', $id)->update([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_name_bn' => $request->brand_name_bn,
            'brand_slug_bn' => str_replace(' ', '-', $request->brand_name_bn),
            'brand_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Brand updated Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->route('brand.view')->with($notification);
    }

    //  active
    public function active($id){

        Brand::where('id', $id)->update([
            'status' => '1',
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Brand active Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    //  inactive
    public function inactive($id){
        Brand::where('id', $id)->update([
            'status' => '0',
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Brand inactive Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //  delete
    public function delete($id){
        $brand = Brand::findOrFail($id);
        if ($brand->brand_image != 'upload/avater.jpg') {
            unlink($brand->brand_image);
        }
        $brand->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}