<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryView() {

        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request) {

        $request->validate([
            'category_name_en' => 'required',
            'category_name_ar' => 'required',
            'category_icon' => 'required',
            
        ],[
            'category_name_en.required' => 'Input Category English Name',
    		'category_name_ar.required' => 'Input Category Arabic Name',
        ]);

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ar' => strtolower(str_replace(' ', '-', $request->category_name_ar)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
			'message' => 'Category Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    }

    public function CategoryEdit($id) {

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));

    }

    public function CategoryUpdate(Request $request) {

        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ar' => strtolower(str_replace(' ', '-', $request->category_name_ar)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
			'message' => 'Category Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('all.category')->with($notification);

    }

    public function CategoryDelete($id) {

        $category = Category::findOrFail($id);

        $category->delete();

        $notification = array(
			'message' => 'Category Deleted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('all.category')->with($notification);
    }



}
