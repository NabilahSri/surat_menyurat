<?php

namespace App\Http\Controllers;

use App\Models\Perihal;
use Illuminate\Http\Request;
use App\Models\UnitKerja;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function showSm(Request $request) {
        $data['unitkerja'] = UnitKerja::all();
        $data['perihal'] = Perihal::all();
        return view('reportsm', $data);
    }

    public function reportsm(Request $request) {
        // Filter data surat masuk berdasarkan input pengguna
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $unitKerjaId = $request->input('id_unit_kerja');
        $perihal = $request->input('perihal');

        $query = SuratMasuk::query();

        // Filter berdasarkan tanggal
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            $query->whereBetween('tanggal_surat', [$tanggalAwal, $tanggalAkhir]);
        }

        // Filter berdasarkan unit kerja
        if (!empty($unitKerjaId)) {
            $query->leftJoin('disposisis', 'surat_masuks.id', '=', 'disposisis.id_surat_masuk')
            ->leftJoin('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
            ->select(
                'surat_masuks.*',
                'disposisis.disposisi',
            )
            ->where('disposisis.disposisi', $unitKerjaId);
        }

        if (!empty($perihal)) {
            $query->select('surat_masuks.*')->where('id_perihal', $perihal);
        }

        // Ambil data surat masuk sesuai filter
        $suratMasuk = $query->get();

        $request->session()->put('filter_criteria', [
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
            'id_unit_kerja' => $unitKerjaId,
            'perihal' => $perihal,
        ]);

        return view('reportsm_tabel', compact('suratMasuk'));
    }

    public function cetak_pdf_sm(Request $request) {
        $filterCriteria = $request->session()->get('filter_criteria');
        $tanggalAwal = $filterCriteria['tanggal_awal'];
        $tanggalAkhir = $filterCriteria['tanggal_akhir'];
        $unitKerjaId = $filterCriteria['id_unit_kerja'];
        $perihal = $filterCriteria['perihal'];

        $query = DB::table('surat_masuks')
        ->leftJoin('disposisis', 'surat_masuks.id', '=', 'disposisis.id_surat_masuk')
        ->leftJoin('unit_kerjas', 'disposisis.disposisi', '=', 'unit_kerjas.id')
        ->select(
            'surat_masuks.*',
            'disposisis.disposisi',
            'unit_kerjas.nama_unit_kerja as unit_kerja_nama'
        );

        // Filter berdasarkan tanggal
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            $query->whereBetween('tanggal_surat', [$tanggalAwal, $tanggalAkhir]);
        }

        // Filter berdasarkan unit kerja
        if (!empty($unitKerjaId)) {
            $query
            ->where('disposisis.disposisi', $unitKerjaId);
        }

        if (!empty($perihal)) {
            $query->select('surat_masuks.id_perihal')->where('id_perihal', $perihal);
        }

        // Ambil data surat masuk sesuai filter
        $suratmasuk = $query->get();

        $jumlahsuratmasuk = $suratmasuk->count();
        $pdf = PDF::loadview('suratmasuk_pdf', ['suratmasuk' => $suratmasuk, 'jumlahsuratmasuk' => $jumlahsuratmasuk, 'tgl_awal' => $tanggalAwal, 'tgl_akhir' => $tanggalAkhir])->setPaper('a4', 'landscape');
        return $pdf->stream();
        $request->session()->forget('filter_criteria');

    }

    public function showSk(Request $request) {
        $data['unitkerja'] = UnitKerja::all();
        $data['perihal'] = Perihal::all();

        return view('reportsk', $data);
    }

    public function reportsk(Request $request) {
        // Filter data surat masuk berdasarkan input pengguna
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $unitKerjaId = $request->input('pengirim');
        $perihal = $request->input('perihal');

        $query = SuratKeluar::query();

        // Filter berdasarkan tanggal
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            $query->whereBetween('tanggal_surat', [$tanggalAwal, $tanggalAkhir]);
        }

        // Filter berdasarkan unit kerja
        if (!empty($unitKerjaId)) {
            $query->where('pengirim', $unitKerjaId);
        }

        if (!empty($perihal)) {
            $query->where('id_perihal', $perihal);
        }

        // Ambil data surat masuk sesuai filter
        $data['suratKeluar'] = $query->get();

        $request->session()->put('filter_criteria', [
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
            'pengirim' => $unitKerjaId,
            'perihal' => $perihal,
        ]);

        return view('reportsk_tabel', $data);
    }

    public function cetak_pdf_sk(Request $request) {
        $filterCriteria = $request->session()->get('filter_criteria');
        $tanggalAwal = $filterCriteria['tanggal_awal'];
        $tanggalAkhir = $filterCriteria['tanggal_akhir'];
        $unitKerjaId = $filterCriteria['pengirim'];
        $perihal = $filterCriteria['perihal'];

        $query = SuratKeluar::query();

        // Filter berdasarkan tanggal
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            $query->whereBetween('tanggal_surat', [$tanggalAwal, $tanggalAkhir]);
        }

        // Filter berdasarkan unit kerja
        if (!empty($unitKerjaId)) {
            $query->where('pengirim', $unitKerjaId);
        }

        if (!empty($perihal)) {
            $query->where('id_perihal', $perihal);
        }

        $suratkeluar = $query->with('unitkerja')->get();

        if (!empty($suratkeluar)) {
            $unitkerja = $suratkeluar->isEmpty() ? null : $suratkeluar->first()->unitkerja;

            $unitkerjaNama = $unitkerja ? $unitkerja->nama_unit_kerja : '-';

            $jumlahsuratkeluar = $suratkeluar->count();

        }

        $pdf = PDF::loadview('suratkeluar_pdf', ['suratkeluar' => $suratkeluar, 'unitkerjaNama' => $unitkerjaNama, 'jumlahsuratkeluar' => $jumlahsuratkeluar, 'tgl_awal' => $tanggalAwal, 'tgl_akhir' => $tanggalAkhir])->setPaper('a4', 'landscape');
        return $pdf->stream();
        $request->session()->forget('filter_criteria');

    }
}
