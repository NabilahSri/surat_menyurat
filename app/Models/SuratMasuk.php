<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnitKerja;
use App\Models\Disposisi;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = "surat_masuks";
    protected $guarded = "";

    public function unitkerja() {
        return $this->belongsTo(UnitKerja::class, 'id_unit_kerja');
    }

     public function perihal() {
        return $this->belongsTo(Perihal::class, 'id_perihal');
    }

    public function disposisi() {
        return $this->hasMany(Disposisi::class, 'id');
    }
}
