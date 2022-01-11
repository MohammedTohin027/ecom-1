<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //  view
    public function view(){
        $data['categories'] = Category::orderBy('id', 'asc')->get();
        return view('admin.category.view', $data);
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'category_name_en' => 'required|unique:categories,category_name_en',
            'category_name_bn' => 'required|unique:categories,category_name_bn',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'category name english field is required',
            'category_name_bn.required' => 'category name bangla field is required',
            'category_icon.required' => 'category icon field is required',
        ]);
        $data = new Category();
        $data->category_name_en = $request->category_name_en;
        $data->category_slug_en = strtolower(str_replace(' ','-',$request->category_name_en));
        $data->category_name_bn = $request->category_name_bn;
        $data->category_slug_bn = str_replace(' ','-',$request->category_name_bn);
        $data->category_icon = $request->category_icon;
        $data->created_at = Carbon::now();
        $data->save();
        $notification = [
            'message' => 'Category inserted Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //  edit
    public function edit($id){
        $data['category'] = Category::findOrFail($id);
        return view('admin.category.edit', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'category_name_en' => 'required|unique:categories,category_name_en,'.$id,
            'category_name_bn' => 'required|unique:categories,category_name_bn,'.$id,
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'category name english field is required',
            'category_name_bn.required' => 'category name bangla field is required',
            'category_icon.required' => 'category icon field is required',
        ]);
        $data = Category::where('id', $id)->update([
            'category_name_en' => $request->category_name_en,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_name_bn' => $request->category_name_bn,
            'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
            'category_icon' => $request->category_icon,
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Category updated Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->route('category.view')->with($notification);
    }

    //  active
    public function active($id){
        Category::where('id', $id)->update([
            'status' => '1',
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Category active Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    //  inactive
    public function inactive($id){
        Category::where('id', $id)->update([
            'status' => '0',
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Category inactive Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //  delete
    public function delete($id){
        Category::findOrFail($id)->delete();
        $notification = [
            'message' => 'Category Deleted Successfully !',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}