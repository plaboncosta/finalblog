<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
    	$posts = Post::all();
    	$popular_posts = Post::
    		withCount('comments')
    		->withCount('favorite_to_users')
    		->orderBy('view_count', 'desc')
    		->orderBy('comments_count', 'desc')
    		->orderBy('favorite_to_users_count', 'desc')
    		->take(5)->get();
    	$total_pending_post = Post::where('is_approved', false)->count();
    	$total_views = Post::sum('view_count');
    	$total_authors = User::authors()->count();
    	$today_new_authors = User::authors()
    		->whereDate('created_at', Carbon::today())->count();
    	$active_authors = User::authors()
    		->withCount('posts')	
    		->withCount('comments')	
    		->withCount('favorite_posts')
    		->orderBy('posts_count', 'desc')	
    		->orderBy('comments_count', 'desc')	
    		->orderBy('favorite_posts_count', 'desc')
    		->take(10)->get();
    	$category_count = Category::all()->count();	
    	$tag_count = Tag::all()->count();	
    	return view('admin.dashboard', compact('posts', 'popular_posts', 'total_pending_post', 'total_views', 'total_authors', 'today_new_authors', 'active_authors', 'category_count', 'tag_count'));
    }
}
