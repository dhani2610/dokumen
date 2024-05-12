<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request){
        $data['page_title'] = 'Dashboard';
        
		return view('dashboard',$data);
    }

    public function home(Request $request){
        $data['page_title'] = 'Home';
        $data['info'] = Informasi::first();

		return view('landing.home',$data);
    }
}
