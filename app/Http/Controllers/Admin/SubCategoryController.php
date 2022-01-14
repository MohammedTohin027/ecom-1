<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    //  view
    public function view(){
        $data['subcategories'] = SubCategory::orderBy('id', 'asc')->get();
        return view('admin.sub-category.view', $data);
    }
    //  create
    public function create(){
        $data['categories'] = Category::where('status', '1')->orderBy('category_name_en', 'asc')->get();
        return view('admin.sub-category.create', $data);
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'sub_category_name_en' => 'required|unique:sub_categories,sub_category_name_en',
            'sub_category_name_bn' => 'required|unique:sub_categories,sub_category_name_bn',
        ],[
            'sub_category_name_en.required' => 'subcategory name english field is required',
            'sub_category_name_bn.required' => 'subcategory name bangla field is required',
            'category_id.required' => 'category name field is required',
        ]);
        SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', $request->sub_category_name_en)),
            'sub_category_name_bn' => $request->sub_category_name_bn,
            'sub_category_slug_bn' => str_replace(' ', '-', $request->sub_category_name_bn),
            'created_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Sub Category inserted Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->route('sub-category.view')->with($notification);
    }

    //  edit
    public function edit($id){
        // return $id;
        $data['editData'] = SubCategory::findOrFail($id);
        $data['categories'] = Category::where('status', '1')->orderBy('category_name_en', 'asc')->get();
        return view('admin.sub-category.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'sub_category_name_en' => 'required|unique:sub_categories,sub_category_name_en,'.$id,
            'sub_category_name_bn' => 'required|unique:sub_categories,sub_category_name_bn,'.$id,
        ],[
            'sub_category_name_en.required' => 'subcategory name english field is required',
            'sub_category_name_bn.required' => 'subcategory name bangla field is required',
            'category_id.required' => 'category name field is required',
        ]);
        SubCategory::where('id', $id)->update([
            'category_id' => $request->category_id,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', $request->sub_category_name_en)),
            'sub_category_name_bn' => $request->sub_category_name_bn,
            'sub_category_slug_bn' => str_replace(' ', '-', $request->sub_category_name_bn),
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Sub Category updated Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->route('sub-category.view')->with($notification);
    }

    //  active
    public function active($id){
        SubCategory::where('id', $id)->update([
            'status' => '1',
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Sub Category active Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    //  inactive
    public function inactive($id){
        SubCategory::where('id', $id)->update([
            'status' => '0',
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Sub Category inactive Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //  delete
    public function delete($id){
        SubCategory::findOrFail($id)->delete();
        $notification = [
            'message' => 'Sub Category Deleted Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);

   }
}