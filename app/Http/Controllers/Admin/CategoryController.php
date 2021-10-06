<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', [
            'categories' =>  $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);
        //get form image
        $image = $request->file('image');

        $slug = Str::slug($request->name);

        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            //check category dir is exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            //resize image for category and upload
            $category = Image::make($image)->resize(1600, 479)->save($imageName . '.' . $image->getClientOriginalExtension());
            Storage::disk('public')->put('category/' . $imageName, $category);
            //check category slider dir is exists
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //resize image for category slider and upload
            $slider = Image::make($image)->resize(500, 333)->save($imageName . '.' . $image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);
        } else {
            $imageName = 'default.png';
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Successfully Saved :)', 'Success');
        return redirect()->route('admin.category.index');
    }


    public function show($id)
    {
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);
        //get form image
        $image = $request->file('image');

        $slug = Str::slug($request->name);
        $category = Category::find($id);

        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            //check category dir is exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            //delete old image
            if (Storage::disk('public')->exists('category/' . $category->image)) {
                Storage::disk('public')->delete('category/' . $category->image);
            }

            //resize image for category and upload
            $category = Image::make($image)->resize(1600, 479)->save($imageName . '.' . $image->getClientOriginalExtension());
            Storage::disk('public')->put('category/' . $imageName, $category);
            //check category slider dir is exists
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //delete old  slider image
            if (Storage::disk('public')->exists('category/slider/' . $category->image)) {
                echo 'đây là old slider delete';
                //Storage::disk('public')->delete('category/slider/' . $category->image);
            }
            die();

            //resize image for category slider and upload
            $slider = Image::make($image)->resize(500, 333)->save($imageName . '.' . $image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);
        } else {
            $imageName = $category->image;
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Successfully Updated :)', 'Success');
        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (Storage::disk('public')->exists('category/' . $category->image)) {
            Storage::disk('public')->delete('category/' . $category->image);
        }

        if (Storage::disk('public')->exists('category/slider/' . $category->image)) {
            Storage::disk('public')->delete('category/slider/' . $category->image);
        }
        $category->delete();
        Toastr::success('Category Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
