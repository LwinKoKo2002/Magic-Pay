<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PageController extends Controller
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.home', [
            'user'=>$user
        ]);
    }

    public function profile()
    {
        return view('frontend.profile');
    }

    public function changePassword()
    {
        return view('frontend.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'=>['required'],
            'new_password'=>['required',Password::min(8)->mixedCase()->numbers()->symbols()]
        ], [
            'old_password.required'=>'Please fill your old password.',
            'new_password.required'=>'Please fill your new Password.'
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = auth()->guard('web')->user();
        if (Hash::check($old_password, $user->password)) {
            $user->password = $new_password;
            $user->update();
            return redirect()->route('profile')->with('success', 'Successfully updated your password.');
        }
        return back()->withErrors(['old_password'=>'Your old password is not correct'])->withInput();
    }

    public function wallet()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.wallet', [
            'user'=>$user
        ]);
    }

    public function transfer()
    {
        return view('frontend.transfer');
    }
}
