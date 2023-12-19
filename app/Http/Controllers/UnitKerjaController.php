<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitKerja;

class UnitKerjaController extends Controller
{
    public function show() {
        $data['unitkerja'] = UnitKerja::all();
        return view('unitkerja',$data);
    }

    public function create(Request $req){
        $this->validate($req,[
            'nama_unit_kerja'=>'required'
        ]);
        UnitKerja::create([
            'nama_unit_kerja'=>$req->nama_unit_kerja
        ]);
        return redirect('unit-kerja');
    }

    public function update(Request $req){
        $this->validate($req,[
            'nama_unit_kerja'=>'required'
        ]);
        UnitKerja::where('id',$req->id)->update([
            'nama_unit_kerja'=>$req->nama_unit_kerja
        ]);
        return redirect('unit-kerja');
    }

    public function delete($id){
        $unitkerja = UnitKerja::where('id',$id)->first();
        $unitkerja->delete();
        return redirect('unit-kerja');
    }
}
