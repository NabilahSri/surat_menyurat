<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UnitKerja;

class LoginController extends Controller
{
    public function show(){
        $user = Auth::user()->id;
        $data['unitkerja'] = UnitKerja::all();
        $data['user'] = User::with('unitkerja')->where('id',$user)->first();
        return view('profile',$data);
    }

    public function actionlogin(Request $req){
        $credential = $req->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credential)) {
            // Successful login
            return redirect('dashboard');
        } else {
            // Failed login
            return redirect()->back()->with('loginError', 'Invalid username or password.');
        }
    }


    public function update(Request $req){
        $user = User::find($req->id);

        // Cek apakah password baru diisi dalam form
        if (!empty($req->password)) {
            $newPassword = bcrypt($req->password);
        } else {
            // Jika password tidak diisi, gunakan password sebelumnya
            $newPassword = $user->password;
        }
        User::where('id',$req->id)->update([
            'name'=>$req->nama,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'jenis_kelamin'=>$req->jenis_kelamin,
            'id_unit_kerja'=>$req->id_unit_kerja,
            'username'=>$req->username,
            'password'=>$newPassword,
        ]);
        $user = User::find($req->id);
        if ($req->hasFile('foto')) {
            if (!is_null($user->foto)) {
                Storage::delete($user->foto);
            }
            $foto = $req->file('foto')->storeAs('foto_users', $req->nama . '.' . $req->file('foto')->getClientOriginalExtension());
        } else {
            $foto = $user->foto;
        }
        $user->update(['foto' => $foto]);
        return redirect('profile');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
