<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Jenis Document';
        $data['jenis'] = JenisDokumen::orderBy('id','desc')->get();
        // dd($data);
		return view('jenis/jenis',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $new = new JenisDokumen();
            $new->jenis = $request->jenis;
            $new->tautan_dokumen = $request->tautan_dokumen;
    
            if ($new->save()) {
                return redirect()->back()->with('success','Successfuly Created Data!');
            }else{
                return redirect()->back()->with('failed','Failed Created Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(JenisDokumen $jenisDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisDokumen $jenisDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $new = JenisDokumen::find($id);
            $new->jenis = $request->jenis;
            $new->tautan_dokumen = $request->tautan_dokumen;
    
            if ($new->save()) {
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $new = JenisDokumen::find($id);
    
            if ($new->delete()) {
                return redirect()->back()->with('success','Successfuly Deleted Data!');
            }else{
                return redirect()->back()->with('failed','Failed Deleted Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }
}
