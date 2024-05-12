<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
   
    public function index()
    {
        $data['page_title'] = 'Setting Informasi';
        $data['info'] = Informasi::first();
        return view('setting/index',$data);
    }

    public function update(Request $request, Informasi $informasi)
    {
        try {
            $cel = Informasi::first();
            if ($cel != null) {
                $data = Informasi::first();
            }else{
                $data = new Informasi();
            }
            $data->informasi = $request->informasi;
    
            if ($data->save()) {
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    public function imageStore(Request $request){
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/upload_img/');
            $image->move($destinationPath, $name);
        }
        return response()->json(['url' => '/assets/img/upload_img/' . $name]);
    }

}
