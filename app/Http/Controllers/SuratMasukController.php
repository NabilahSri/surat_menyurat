<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\UnitKerja;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDF;

class SuratMasukController extends Controller
{
    public function show() {
        if (Auth::user()->role === "superadmin" || Auth::user()->role === "admin") {
            $data['unitkerja'] = UnitKerja::all();
            $data['suratmasuk'] = SuratMasuk::with('unitkerja')
            ->orderBy('created_at', 'desc')
            ->get();
            $data['suratmasuk'] = $data['suratmasuk']->sortBy(function ($surat) {
                switch ($surat->sifat_surat) {
                    case 'segera':
                        return 1;
                    case 'penting':
                        return 2;
                    case 'rahasia':
                        return 3;
                    default:
                        return 4;
                }
            });
            $data['disposisi2'] = Disposisi::select('surat_masuks.*', 'unit_kerjas.*', 'surat_masuks.id as IdSuratMasuk')
            ->join('surat_masuks', 'disposisis.id_surat_masuk', '=', 'surat_masuks.id')
            ->join('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            // ->groupBy('surat_masuks.id','surat_masuks.id_user')
            ->get();
            $data['disposisi'] = Disposisi::with('unitkerja', 'unitkerja2')->get();
            $user = Auth::user();
            $data['dari_bagian'] = $user::with('unitkerja')->first();
        }else {
            $user = Auth::user()->id_unit_kerja;

            $data['suratmasuk'] = Disposisi::select('surat_masuks.*', 'unit_kerjas.*', 'surat_masuks.id as IdSuratMasuk')
                ->join('surat_masuks', 'disposisis.id_surat_masuk', '=', 'surat_masuks.id')
                ->join('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
                ->where('disposisis.disposisi', $user)
                ->orderBy('surat_masuks.created_at', 'desc')
                ->get();

                $data['suratmasuk'] = $data['suratmasuk']->sortBy(function($surat) {
                    switch ($surat->sifat_surat) {
                        case 'segera':
                            return 1;
                        case 'penting':
                            return 2;
                        case 'rahasia':
                            return 3;
                        default:
                            return 4;
                    }
                });

            $data['unitkerja'] = UnitKerja::all();
            $data['disposisi'] = Disposisi::with('unitkerja', 'unitkerja2')->get();
            // $data['disposisi'] = DB::table('disposisis')->where('disposisi', $user)->get();
        }
        return view('suratmasuk',$data);
    }

    public function create(Request $req){
        $user = Auth::user()->id;
        $tanggal = Carbon::now('Asia/Jakarta');
        $this->validate($req,[
            'nomor_surat'=>'required',
            'tanggal_surat'=>'required',
            'sifat_surat'=>'required',
            'pengirim'=>'required',
            'perihal'=>'required',
            'isi_surat_ringkas'=>'required',
        ]);
        $file = $req->file('file');
        $file_path = null;

        if ($file) {
            $file_path = $file->store('file_surat_masuk');
        }

        SuratMasuk::create([
            'id_user'=>$user,
            'nomor_surat'=>$req->nomor_surat,
            'tanggal_surat'=>$req->tanggal_surat,
            'sifat_surat'=>$req->sifat_surat,
            'pengirim'=>$req->pengirim,
            'perihal'=>$req->perihal,
            'isi_surat_ringkas'=>$req->isi_surat_ringkas,
            'tanggal'=>$tanggal,
            'status'=>'Open',
            'file'=>$file_path
        ]);
        return redirect('surat-masuk');
    }

    public function update(Request $req){
        $user = Auth::user()->id;
        $tanggal = Carbon::now('Asia/Jakarta');
        $this->validate($req,[
            'nomor_surat'=>'required',
            'tanggal_surat'=>'required',
            'sifat_surat'=>'required',
            'pengirim'=>'required',
            'perihal'=>'required',
            'isi_surat_ringkas'=>'required',
        ]);
        SuratMasuk::where('id',$req->id)->update([
            'id_user'=>$user,
            'nomor_surat'=>$req->nomor_surat,
            'tanggal_surat'=>$req->tanggal_surat,
            'sifat_surat'=>$req->sifat_surat,
            'pengirim'=>$req->pengirim,
            'perihal'=>$req->perihal,
            'isi_surat_ringkas'=>$req->isi_surat_ringkas,
            'tanggal'=>$tanggal,
        ]);
        return redirect('surat-masuk');
    }

    public function delete($id){
        $suratmasuk = SuratMasuk::where('id',$id)->first();
         // Hapus file jika ada
         if ($suratmasuk->file) {
            Storage::delete($suratmasuk->file);
        }
        $suratmasuk->delete();
        return redirect('surat-masuk');
    }

    public function disposisi(Request $req){
        $tanggal = Carbon::now('Asia/Jakarta');
        $disposisi = Disposisi::where('id_surat_masuk', $req->id)->latest()->first();
        if ($disposisi) {
            Disposisi::create([
                'id_user'=>Auth::user()->id,
                'id_surat_masuk'=>$req->id,
                'disposisi'=>$req->id_unit_kerja,
                'isi_disposisi'=>$req->isi_disposisi,
                'dari_bagian'=>$disposisi->disposisi,
                'tanggal' => $tanggal
            ]);
        }else{
            Disposisi::create([
                'id_user'=>Auth::user()->id,
                'id_surat_masuk'=>$req->id,
                'disposisi'=>$req->id_unit_kerja,
                'isi_disposisi'=>$req->isi_disposisi,
                'dari_bagian'=>Auth::user()->id_unit_kerja,
                'tanggal' => $tanggal
            ]);
        }
        return redirect('surat-masuk');
    }

    public function update_file(Request $req){
        $suratmasuk = SuratMasuk::find($req->id);
        if ($req->hasFile('file')) {
            if (!is_null($suratmasuk->file)) {
                Storage::delete($suratmasuk->file);
            }
            $file = $req->file('file')->store('file_surat_masuk');
        } else {
            $file = $suratmasuk->file;
        }
        $suratmasuk->update(['file' => $file]);
    
        return redirect('surat-masuk');
    } 

    public function cetak_pdf_sm(Request $request) {
        if (Auth::user()->role === "superadmin" || Auth::user()->role == "admin") {
            $suratmasuk = DB::table('surat_masuks')
                ->leftJoin('disposisis', 'surat_masuks.id', '=', 'disposisis.id_surat_masuk')
                ->leftJoin('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
                ->select(
                    'surat_masuks.*',
                    'disposisis.disposisi as disposisi_disposisis',
                    'unit_kerjas.nama_unit_kerja as unit_kerja_nama'
                )
                ->get();
        }else {
            $user = Auth::user()->id_unit_kerja;

            $suratmasuk = DB::table('surat_masuks')
                ->leftJoin('disposisis', 'surat_masuks.id', '=', 'disposisis.id_surat_masuk')
                ->leftJoin('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
                ->select(
                    'surat_masuks.*',
                    'disposisis.disposisi',
                    'unit_kerjas.nama_unit_kerja as unit_kerja_nama'
                )
                ->where('disposisis.disposisi', $user)
                ->get();
        }

        $jumlahsuratmasuk = $suratmasuk->count();
        
        $pdf = PDF::loadview('pdf_suratmasuk', ['suratmasuk' => $suratmasuk, 'jumlahsuratmasuk' => $jumlahsuratmasuk])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function penyimpanan(Request $req){
        SuratMasuk::where('id',$req->id)->update([
            'lokasi_penyimpanan' => $req->lokasi_penyimpanan,
            'status' => "Close",
        ]);
        return redirect('surat-masuk');
    }
}
