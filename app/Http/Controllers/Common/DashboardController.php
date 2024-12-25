<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::guard('web')->user();

            return $next($request);
        });
    }

    public function dashboard()
    {
        return view('backend.dashboard.admin.index');
    }

    public function profilePage()
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $userData = $this->user;
        return view('backend.dashboard.common.profiles.index', compact('userData'));
    }
    public function updateUserDetails(Request $request)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            'email'  => 'required|email|unique:users,email,' . $this->user->id,
            'name' => 'required|string|max:255',
        ]);

        $user = User::find($this->user->id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        session()->flash('success', 'Details has been updated successfully !!');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $request->validate([
            'old_password'  => 'required|min:8',
            'password' => 'confirmed|min:8|different:old_password'
        ]);

        if (Hash::check($request->old_password, $this->user->password)) {
            $user = User::find($this->user->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['success' => true, 'message' => 'Password has been updated successfully !!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Old Password is incorrect !!'], 200);
        }
    }


    public function uploadProfileMedia(Request $request)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            return abort(403, 'You are not allowed to access this page !');
        }
        $urls = [];
        foreach ($request->images as $image) {
            array_push($urls, temporaryImageUpload($image));
        }
        return response()->json(['success' => true, 'urls' => $urls]);
    }

    public function removeProfileMedia(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole(['admin', 'customer'])) {
            return abort(403, 'You are not allowed to access this page !');
        }
        if ($request->fromStorage == true) {
            $originalImagePath = str_replace('/t/', '/o/', $request->image);
            imageDelete($originalImagePath);
            $listImagePath = str_replace('/t/', '/l/', $request->image);
            imageDelete($listImagePath);
            return response()->json(['success' => imageDelete($request->image)]);
        } else {
            return response()->json(['success' => removeTemporaryImage($request->image)]);
        }
    }
    public function profileMediaUpload(Request $request)
    {
        if (is_null($this->user) || !$this->user->hasRole(['admin', 'user'])) {
            return abort(403, 'You are not allowed to access this page !');
        }
        $itemInputImages = json_decode($request->profileImage, true);
        $user = User::find($this->user->id);

        if ($itemInputImages && $itemInputImages[0]['image']) {
            $mediaImage = imageMove($itemInputImages[0]['image'], $folderName = 'profileImage', $imageStoreTypes = ['originalSize']);
            $originalSize = $mediaImage['originalSize'];

            $user->avatar = $originalSize;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully !!'], 200);
        } else {
            $user->avatar = null;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully !!'], 200);
        }
    }
}
