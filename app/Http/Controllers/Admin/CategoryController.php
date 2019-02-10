<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,jpg,png',
        ]);

        // Get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image))
        {
            // Set Unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Check Category Folder existence
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // Resize image for category and upload
            $categoryimage = Image::make($image)->resize(1600, 479)->save($imagename);
            Storage::disk('public')->put('category/' . $imagename , $categoryimage);

            // Check Slider Folder existence
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // Resize image for Slider and upload
            $sliderimage = Image::make($image)->resize(500, 333)->save($imagename);
            Storage::disk('public')->put('category/slider/' . $imagename , $sliderimage);
        }
        else
        {
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();

        Toastr::success('Category Added Successfully', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,jpg,png',
        ]);

        // Get form image
        $category = Category::find($id);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image))
        {
            // Set Unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Check Category Folder existence
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            // Delete Old category image
            if(Storage::disk('public')->exists('category/' . $category->image))
            {
                Storage::disk('public')->delete('category/' . $category->image);
            }

            // Resize image for category and upload
            $categoryimage = Image::make($image)->resize(1600, 479)->save($imagename);
            Storage::disk('public')->put('category/' . $imagename , $categoryimage);

            // Check Slider Folder existence
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // Delete Old Slider image
            if(Storage::disk('public')->exists('category/slider/' . $category->image))
            {
                Storage::disk('public')->delete('category/slider/' . $category->image);
            }

            // Resize image for Slider and upload
            $sliderimage = Image::make($image)->resize(500, 333)->save($imagename);
            Storage::disk('public')->put('category/slider/' . $imagename , $sliderimage);
        }
        else
        {
            $imagename = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();

        Toastr::success('Category Updated Successfully', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        // Delete Old category image
            if(Storage::disk('public')->exists('category/' . $category->image))
            {
                Storage::disk('public')->delete('category/' . $category->image);
            }

            // Delete Old Slider image
            if(Storage::disk('public')->exists('category/slider/' . $category->image))
            {
                Storage::disk('public')->delete('category/slider/' . $category->image);
            }


            $category->delete();

            Toastr::success('Category Deleted Successfully', 'Success');
            return redirect()->route('admin.category.index');


    }
}
