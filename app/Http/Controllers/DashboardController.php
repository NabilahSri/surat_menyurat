<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UnitKerja;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function show() { 
        if (Auth::user()->role === "superadmin" || Auth::user()->role === "admin") {
            $data['unitkerja'] = UnitKerja::count();
            $data['suratmasuk'] = SuratMasuk::count();
            $data['suratkeluar'] = SuratKeluar::count();
            $data['disposisi'] = Disposisi::count();
            $data['totalSurat'] = $data['suratmasuk'] + $data['suratkeluar'];
    
            $json_divisi = $this->json_namadivisi();
            $totaldivisi = $this->json_divisi();
    
            $tanggal = Carbon::now('Asia/Jakarta');
    
            $data['jml_surat_masuk'] = Disposisi::select('unit_kerjas.nama_unit_kerja', DB::raw("COUNT(*) as jml"))
            ->join('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            ->join('surat_masuks', 'disposisis.id_surat_masuk', '=', 'surat_masuks.id')
            ->whereDate('surat_masuks.tanggal', $tanggal)
            ->groupBy('nama_unit_kerja')
            ->get();
        }else{
            $user = Auth::user()->id_unit_kerja;

            $data['suratmasuk'] = DB::table('surat_masuks')
            ->leftJoin('disposisis', 'surat_masuks.id', '=', 'disposisis.id_surat_masuk')
            ->leftJoin('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            ->select(
                'surat_masuks.*',
                'disposisis.disposisi',
                'unit_kerjas.nama_unit_kerja as unit_kerja_nama'
            )
            ->where('disposisis.disposisi', $user)
            ->count();

            $data['suratkeluar'] = SuratKeluar::where('pengirim', $user)->count();
            $data['disposisi'] = DB::table('disposisis')->where('disposisi', $user)->count();
            $data['totalSurat'] = $data['suratmasuk'] + $data['suratkeluar'];

            $json_divisi = $this->json_namadivisi();
            $totaldivisi = $this->json_divisi();
    
            $tanggal = Carbon::now('Asia/Jakarta');
    
            $data['jml_surat_masuk'] = Disposisi::select('unit_kerjas.nama_unit_kerja', DB::raw("COUNT(*) as jml"))
            ->join('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            ->join('surat_masuks', 'disposisis.id_surat_masuk', '=', 'surat_masuks.id')
            ->whereDate('surat_masuks.tanggal', $tanggal)
            ->groupBy('nama_unit_kerja')
            ->get();

        }
    
        return view('dashboard', $data, compact('json_divisi','totaldivisi'));
    }
 
    public function json_namadivisi() {
        $json = [];
        $query = Disposisi::select('unit_kerjas.nama_unit_kerja')
            ->join('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            ->groupBy('nama_unit_kerja')->get();

        $json[] = 'Unit Kerja/Bagian';

        return json_encode($json);
    }
 
    public function json_divisi() {
        $json = [];

        $query = Disposisi::select('unit_kerjas.nama_unit_kerja', DB::raw("COUNT(*) as jml"))
            ->join('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            ->groupBy('nama_unit_kerja')
            ->get();

        foreach ($query as $row) {
            $json[] = ['name' => $row->nama_unit_kerja, 'data' => [$row->jml]]; // Menambahkan dua data di bawah kolom
        }

        return json_encode($json);
    }

}
