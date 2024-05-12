<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Program Studi';
        $data['pg'] = ProgramStudi::orderBy('id','desc')->get();
		return view('pg/pg',$data);
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
            $new = new ProgramStudi();
            $new->program = $request->program_studi;
    
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
    public function show(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $new = ProgramStudi::find($id);
            $new->program = $request->program_studi;
    
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
            $new = ProgramStudi::find($id);
    
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
