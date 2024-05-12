<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;

class ResetController extends Controller
{
    public function create()
    {
        return view('session/reset-password/sendEmail');
        
    }

    public function changePassword(Request $request)
    {
        $validateData = $request->validate([
            'password' => 'required',
            // 'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (Hash::check($validateData['password'], $user->password)) {
            $user->pw_text = $request->get('new_password');
            $user->password = Hash::make($request->get('new_password'));
            $user->save();

            return redirect()->back()->with('success_update_pw', 'Password Berhasil diubah!');
        } else {
            return redirect()->back()->with('failed__update_pw', 'Password Gagal diubah!');
        }
    }

    public function sendEmail(Request $request)
    {
        if(env('IS_DEMO'))
        {
            return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t recover your password.']);
        }
        else{
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['success' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPass($token)
    {
        return view('session/reset-password/resetPassword', ['token' => $token]);
    }
}
