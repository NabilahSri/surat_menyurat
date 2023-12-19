<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratKeluar;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PDF;

class SuratKeluarController extends Controller
{
    public function show() {
        if (Auth::user()->role === "superadmin" || Auth::user()->role === "admin") {
            $data['unitkerja'] = UnitKerja::all();
            $data['suratkeluar'] = SuratKeluar::with('unitkerja')->get();
            $data['suratkeluar'] = $data['suratkeluar']->sortByDesc(function ($surat) {
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
            })->sortByDesc('created_at');
        }else {
            $user = Auth::user()->id_unit_kerja;
            $data['unitkerja'] = UnitKerja::all();
            $data['suratkeluar'] = SuratKeluar::where('pengirim', $user)->get();
            $data['suratkeluar'] = $data['suratkeluar']->sortByDesc(function ($surat) {
                switch ($surat->sifat) {
                    case 'segera':
                        return 1;
                    case 'penting':
                        return 2;
                    case 'rahasia':
                        return 3;
                    default:
                        return 4;
                }
            })->sortByDesc('created_at');
        }
        return view('suratkeluar',$data);
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
            'tujuan'=>'required',
            'alamat'=>'required',
            'isi_surat_ringkas'=>'required',
        ]);
        $file = $req->file('file');
        $file_path = null;

        if ($file) {
            $file_path = $file->store('file_surat_keluar');
        }
        SuratKeluar::create([
            'id_user'=>$user,
            'nomor_surat'=>$req->nomor_surat,
            'tanggal_surat'=>$req->tanggal_surat,
            'sifat_surat'=>$req->sifat_surat,
            'pengirim'=>$req->pengirim,
            'perihal'=>$req->perihal,
            'tujuan'=>$req->tujuan,
            'alamat'=>$req->alamat,
            'isi_surat_ringkas'=>$req->isi_surat_ringkas,
            'tanggal'=>$tanggal,
            'file'=>$file_path
        ]);
        return redirect('surat-keluar');
    }

    public function update_file(Request $req){
        $suratkeluar = SuratKeluar::find($req->id);
        if ($req->hasFile('file')) {
            if (!is_null($suratkeluar->file)) {
                Storage::delete($suratkeluar->file);
            }
            $file = $req->file('file')->store('file_surat_keluar');
        } else {
            $file = $suratkeluar->file;
        }
        $suratkeluar->update(['file' => $file]);
    
        return redirect('surat-keluar');
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
            'tujuan'=>'required',
            'alamat'=>'required',
            'isi_surat_ringkas'=>'required',
        ]);
        SuratKeluar::where('id',$req->id)->update([
            'id_user'=>$user,
            'nomor_surat'=>$req->nomor_surat,
            'tanggal_surat'=>$req->tanggal_surat,
            'sifat_surat'=>$req->sifat_surat,
            'pengirim'=>$req->pengirim,
            'perihal'=>$req->perihal,
            'tujuan'=>$req->tujuan,
            'alamat'=>$req->alamat,
            'isi_surat_ringkas'=>$req->isi_surat_ringkas,
            'tanggal'=>$tanggal,
        ]);
        return redirect('surat-keluar');
    }

    public function delete($id){
        $suratkeluar = SuratKeluar::where('id',$id)->first();
         // Hapus foto jika ada
         if ($suratkeluar->file) {
            Storage::delete($suratkeluar->file);
        }
        $suratkeluar->delete();
        return redirect('surat-keluar');
    }

    public function cetak_pdf_sk(Request $request)
    {

        if (Auth::user()->role === "superadmin" || Auth::user()->role === "admin") {
            $suratkeluar = SuratKeluar::all();
        }else {
            $user = Auth::user()->id_unit_kerja;
            $suratkeluar = SuratKeluar::where('pengirim', $user)->get();
        }

        if (!empty($suratkeluar)) {
            $unitkerja = $suratkeluar->isEmpty() ? null : $suratkeluar->first()->unitkerja;

            $unitkerjaNama = $unitkerja ? $unitkerja->nama_unit_kerja : '-';

            $jumlahsuratkeluar = $suratkeluar->count();

        }
        
        $pdf = PDF::loadview('pdf_suratkeluar', ['suratkeluar' => $suratkeluar, 'unitkerjaNama' => $unitkerjaNama, 'jumlahsuratkeluar' => $jumlahsuratkeluar])->setPaper('a4', 'landscape');
        return $pdf->stream();

    }
}