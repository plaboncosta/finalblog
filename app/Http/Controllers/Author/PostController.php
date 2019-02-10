<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorPost;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categories', 'tags'));
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
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,bmp',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if($image)
        {
            // Create unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' .  uniqid() . '.' . $image->getClientOriginalExtension();

            // Check Post folder is exists
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            // Resize post image and upload
            $postimage = Image::make($image)->resize(1600, 1066)->save($imagename);
            Storage::disk('public')->put('post/' . $imagename , $postimage);
        }
        else
        {
            $imagename = 'default.png';
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->image = $imagename;
        $post->body = $request->body;
        if($request->status == true)
        {
            $post->status = true;
        }
        else
        {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users= User::where('role_id', 1)->get();
        Notification::send($users, new NewAuthorPost($post));

        Toastr::success('Post Created Successfully', 'Success');
        return redirect()->route('author.post.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to browse this post!');
            return redirect()->back();
        }
        
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to browse this post!');
            return redirect()->back();
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('author.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to browse this post!');
            return redirect()->back();
        }
        
        $this->validate($request, [
            'title' => 'required',
            'image' => 'mimes:jpeg,png,jpg,bmp',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if($image)
        {
            // Create unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' .  uniqid() . '.' . $image->getClientOriginalExtension();

            // Check Post folder is exists
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            // Delete older post image
            if(Storage::disk('public')->exists('post/') . $post->image)
            {
                Storage::disk('public')->delete('post/' . $post->image);
            }

            // Resize post image and upload
            $postimage = Image::make($image)->resize(1600, 1066)->save($imagename);
            Storage::disk('public')->put('post/' . $imagename , $postimage);
        }
        else
        {
            $imagename = $post->image;
        }

        
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->image = $imagename;
        $post->body = $request->body;
        if($request->status == true)
        {
            $post->status = true;
        }
        else
        {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Updated Successfully', 'Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to browse this post!');
            return redirect()->back();
        }
        
        if(Storage::disk('public')->exists('post/') . $post->image)
        {
            Storage::disk('public')->delete('post/' . $post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();
        Toastr::success('Post Deleted Successfully', 'Success');
        return redirect()->route('author.post.index');
    }
}
