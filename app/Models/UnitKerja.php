<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;

class UnitKerja extends Model
{
    use HasFactory;
    protected $table = "unit_kerjas";
    protected $guarded = "";

    public function user() {
        return $this->hasMany(User::class, 'id');
    }

    public function suratmasuk() {
        return $this->hasMany(SuratMasuk::class, 'id');
    }

    public function suratkeluar() {
        return $this->hasMany(SuratKeluar::class, 'id');
    }

    public function disposisi() {
        return $this->hasMany(Disposisi::class, 'id');
    }
}

