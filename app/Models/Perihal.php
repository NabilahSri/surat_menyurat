<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perihal extends Model
{
    use HasFactory;
    protected $table = 'perihal';
    protected $guarded= "";

     public function suratmasuk() {
        return $this->hasMany(SuratMasuk::class, 'id');
    }

    public function suratkeluar() {
        return $this->hasMany(SuratKeluar::class, 'id');
    }
}
