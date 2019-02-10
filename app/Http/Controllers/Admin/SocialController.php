<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Social;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
    	$social = Social::findOrFail(1);
    	return view('admin.social', compact('social'));
    }

    public function update(Request $request)
    {
    	$social = Social::findOrFail(1);
    	$social->facebook = $request->facebook;
    	$social->twitter = $request->twitter;
    	$social->instagram = $request->instagram;
    	$social->vemio = $request->vemio;
    	$social->pinterest = $request->pinterest;
    	$social->save();

    	if($social)
    	{
    		Toastr::success('Social icons updated successfully', 'Success');
    	}
    	return redirect()->back();
    }
}
