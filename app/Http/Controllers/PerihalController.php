<?php

namespace App\Http\Controllers;

use App\Models\Perihal;
use Illuminate\Http\Request;

class PerihalController extends Controller
{
    public function show(){
        $data['perihal'] = Perihal::all();
        return view('perihal',$data);
    }

    public function create(Request $req){
        $this->validate($req,[
            'kode'=>'required',
            'perihal'=>'required'
        ]);
        Perihal::create([
            'kode'=>$req->kode,
            'perihal'=>$req->perihal
        ]);
        return redirect('perihal');
    }

    public function update(Request $req){
        $this->validate($req,[
            'kode'=>'required',
            'perihal'=>'required'
        ]);
        Perihal::where('id',$req->id)->update([
            'kode'=>$req->kode,
            'perihal'=>$req->perihal
        ]);
        return redirect('perihal');
    }

    public function delete($id){
        $perihal = Perihal::where('id',$id)->first();
        $perihal->delete();
        return redirect('perihal');
    }
}
