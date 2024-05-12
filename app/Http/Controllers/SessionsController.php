<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'stambuk'=>'required',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            // if (Auth::user()->status == 2) {
            //     return back()->withErrors(['failed'=>'Akun anda di Non Aktifkan oleh admin! Hubungi admin untuk informasi lebih lanjut.']);
            // }
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        }
        else{

            return back()->withErrors(['email'=>'Stambuk / NIDN atau password Salah.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/')->with(['success'=>'You\'ve been logged out.']);
    }
}
