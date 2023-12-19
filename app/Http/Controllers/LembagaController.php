<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lembaga;

class LembagaController extends Controller
{
    //
    public function show() {
        $data['lembaga'] = Lembaga::all();

        return view('lembaga', $data);
    }

    public function update(Request $req){
        $this->validate($req,[
            'kabupaten'=>'required',
            'telp'=>'required',
            'email'=>'required',
            'alamat'=>'required',
            'nama_ketua'=>'required',
        ]);
        Lembaga::where('id',$req->id)->update([
            'kabupaten'=>$req->kabupaten,
            'telp'=>$req->telp,
            'email'=>$req->email,
            'alamat'=>$req->alamat,
            'nama_ketua'=>$req->nama_ketua,
        ]);

        session()->flash('success', 'Data lembaga has been updated successfully');
        
        return redirect('lembaga');
    }
}