<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjam extends Model
{
    use HasFactory;
    protected $table = 'peminjamanruang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'dtpr_id',
        'user_id',
        'ruang_id',
        'penanggungjawab_id',
        'status_id',
        
    ];
    public function user(){
        return $this->hasOne(user::class,'id','id');
    }
    public function ruang(){
        return $this->belongsTo(ruang::class,'ruang_id','id');
    }
    public function pegawai(){
        return $this->belongsTo(pegawai::class,'pegawai_nip','nip_baru');
    }
    public function dtpr(){
        return $this->belongsTo(detailpeminjamanruang::class,'dtpr_id','id');
    }
    
}
