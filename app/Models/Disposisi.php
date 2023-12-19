<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UnitKerja;

class Disposisi extends Model
{
    use HasFactory;
    protected $table = "disposisis";
    protected $guarded = "";

    public function unitkerja(){
        return $this->belongsTo(UnitKerja::class, 'disposisi');
    }

    public function suratmasuk(){
        return $this->belongsTo(UnitKerja::class, 'id_surat_masuk');
    }

    public function unitkerja2(){
        return $this->belongsTo(UnitKerja::class, 'dari_bagian');
    }
}
