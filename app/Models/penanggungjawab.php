<?php

namespace App\Models;
use App\Models\pegawai;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penanggungjawab extends Model
{
    use HasFactory;
    protected $table = 'penanggungjawab';
    protected $primaryKey = 'id';
    protected $fillable=[
        'pegawai_nip'
    ];
    public function pegawai(){
        return $this->belongsTo(pegawai::class,'pegawai_nip','nip_baru');
    }
}
