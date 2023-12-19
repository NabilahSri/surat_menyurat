<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show() {
        if (Auth::user()->role == "superadmin"){
            $data['user'] = User::with('unitkerja')->get();
            $data['unitkerja'] = UnitKerja::all();
        }else if(Auth::user()->role == "admin"){
            $data['user'] = User::where('role','operator')->with('unitkerja')->get();
            $data['unitkerja'] = UnitKerja::all();
        }
        return view('user', $data);
    }

    public function create(Request $req){
        // Simpan foto ke direktori penyimpanan yang sesuai (misalnya, "public/photos")
        if ($req->hasFile('foto')) {
            $photoPath = $req->file('foto')->storeAs('foto_users', $req->name . '.' . $req->file('foto')->getClientOriginalExtension());
        } else {
            $photoPath = null;
        }
        
        User::create([
            'name'=>$req->name,
            'username'=>$req->username,
            'password'=>bcrypt($req->password),
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'jenis_kelamin'=>$req->jenis_kelamin,
            'id_unit_kerja'=>$req->id_unit_kerja,
            'role'=>$req->role,
            'foto' => $photoPath, // Simpan path foto ke dalam database
        ]);

        return redirect('user');
    }

    public function update(Request $req, $id){
        $user = User::find($id);
        $userData = [
            'name' => $req->name,
            'username' => $req->username,
            'alamat' => $req->alamat,
            'telp' => $req->telp,
            'jenis_kelamin' => $req->jenis_kelamin,
            'id_unit_kerja' => $req->id_unit_kerja,
            'role' => $req->role,
        ];
        if (!empty($req->password)) {
            $userData['password'] = bcrypt($req->password);
        }

        if ($req->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete($user->foto);
            }
    
            // Simpan foto baru ke direktori penyimpanan yang sesuai
            $photoPath = $req->file('foto')->storeAs('foto_users', $req->name . '.' . $req->file('foto')->getClientOriginalExtension());
    
            // Update path foto di database
            $userData['foto'] = $photoPath;
        }
    
        User::where('id', $id)->update($userData);
    
        return redirect('user');
    }
    
    public function delete($id){
        $users = User::where('id',$id)->first();
         // Hapus foto jika ada
         if ($users->foto) {
            Storage::delete($users->foto);
        }
        $users->delete();
        return redirect('user');
    }
}