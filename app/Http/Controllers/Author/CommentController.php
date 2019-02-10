<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
    	$posts = Auth::user()->posts;
    	return view('author.comments', compact('posts'));
    }


    public function destroy($id)
    {
    	$comment = Comment::findOrFail($id);
    	if($comment->post->user->id == Auth::id())
    	{
    		$comment->delete();
    		Toastr::success('Comment deleted Successfully', 'Success');
    	}
    	else
    	{
    		Toastr::error('You are not authorized to access this comment', 'Access denied !!!');
    	}
    	return redirect()->back();
    }
}
