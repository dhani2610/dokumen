<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Document;
use App\Models\JenisDokumen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
class DocumentController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Document';
        if (Auth::user()->role == 'User') {
            $data['dokumen'] = Document::where('id_user',Auth::user()->id)->orderBy('id_user','asc')->get();
            $data['dokumen_val'] = Document::where('id_user',Auth::user()->id)->whereIn('status',[1,2])->orderBy('id','desc')->get();
            $data['jenis'] = JenisDokumen::orderBy('id','desc')->whereNotIn('id',$data['dokumen_val']->pluck('id_jenis'))->get();
        }else{
            $data['dokumen'] = Document::orderBy('id_user','asc')->get();
            $data['dokumen_val'] = [];
            $data['jenis'] = JenisDokumen::orderBy('id','desc')->get();
        }

        $data['format_jenis'] = JenisDokumen::orderBy('id','desc')->get();

        $data['jenis_edit'] = JenisDokumen::orderBy('id','desc')->get();
		return view('document/document',$data);
    }
    
    public function waitingApprove()
    {
        $data['page_title'] = 'Waiting Approve Document';
        $data['dokumen'] = Document::where('status',1)->orderBy('id','desc')->get();
        // dd($data);
		return view('document/document_waiting',$data);
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
            $new = new Document();
            $new->nama_dokumen = $request->nama_dokumen;
          
            $new->id_jenis = $request->id_jenis;
            $new->keterangan = $request->keterangan;
            $new->tautan_dokumen = $request->tautan_dokumen;
            $new->status = 1;
            $new->id_user = Auth::user()->id;
            if ($new->save()) {
                return redirect()->back()->with('success','Successfuly Created Data!');
            }else{
                return redirect()->back()->with('failed','Failed Created Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }
 
    public function updateStatus(Request $request,$id)
    {
        try {
            $new = Document::find($id);
            $new->status = $request->status;
            $new->ket_ditolak = $request->ket_ditolak;
            if ($new->save()) {
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $new = Document::find($id);
            $new->nama_dokumen = $request->nama_dokumen;
            if ($new->id_jenis != $request->id_jenis) {
                $jenis = Document::orderBy('id','desc')->where('id_user',Auth::user()->id)->where('id_jenis',$request->id_jenis)->first();
                if ($jenis->status != 3) {
                    if ($jenis != null) {
                        return redirect()->back()->with('failed','Jenis Document yang dipilih sudah ada!');
                    }
                }
            }
            $new->id_jenis = $request->id_jenis;
            $new->keterangan = $request->keterangan;
            $new->tautan_dokumen = $request->tautan_dokumen;
            $new->id_user = Auth::user()->id;
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
            $new = Document::find($id);
                if ($new->status == 2) {
                    return redirect()->back()->with('failed','Data tersebut tidak dapat dihapus karna sudah diterima oleh admin!');
                }
            if ($new->delete()) {
                return redirect()->back()->with('success','Successfuly Deleted Data!');
            }else{
                return redirect()->back()->with('failed','Failed Deleted Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    public function export_excel()
    {
        // Set locale untuk menggunakan bahasa Indonesia
        Carbon::setLocale('id');

        // Buat objek Carbon dari tanggal saat ini
        $date = Carbon::now();

        // Format tanggal sesuai dengan format yang diinginkan
        $formattedDate = $date->isoFormat('dddd, D MMMM YYYY HH:mm');

        // Buat nama file dengan format yang diinginkan
        $name = 'Laporan ' . $formattedDate . '.xlsx';
        return Excel::download(new LaporanExport, $name);
    }
}
