<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
    	return view('author.settings');
    }

    public function updateProfile(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required|email',
    		'image' => 'image',
    	]);

    	$image = $request->file('image');
    	$slug = str_slug($request->name);
    	$user = User::findOrFail(Auth::id());
    	if($image)
    	{
    		// Create an unique name for image
    		$currentDate = Carbon::now()->toDateString();
    		$imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

    		// Check if profile folder is exists
    		if(!Storage::disk('public')->exists('profile'))
    		{
    			Storage::disk('public')->makeDirectory('profile');
    		}

    		// Delete Older profile image
    		if(Storage::disk('public')->exists('profile/') . $user->image)
    		{
    			Storage::disk('public')->delete('profile/' . $user->image);
    		}


    		// upload profile image and save
    		$profileimage = Image::make($image)->resize(500, 500)->save($imagename);
    		Storage::disk('public')->put('profile/' . $imagename , $profileimage);
    	}
    	else
    	{
    		$imagename = $user->image;
    	}


    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->image = $imagename;
    	$user->about = $request->about;
    	$user->save();

    	Toastr::success('User updated successfully', 'Success');
    	return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required',
    		'password' => 'required|confirmed',
    	]);

    	$hashedPassword = Auth::user()->password;
    	if(Hash::check($request->old_password, $hashedPassword))
    	{
    		if(!Hash::check($request->password, $hashedPassword))
    		{
    			$user = User::findOrFail(Auth::id());
    			$user->password = Hash::make($request->password);
    			$user->save();

    			Toastr::success('Password updated successfully', 'Success');
    			Auth::logout();
    			return redirect()->back();
    		}
    		else
    		{
    			Toastr::error('New password is same as old password!', 'Error');
    			return redirect()->back();
    		}
    	}
    	else
    	{
    		Toastr::error('Old password did not match!', 'Error');
    		return redirect()->back();
    	}
    }
}
