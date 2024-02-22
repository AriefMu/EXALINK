<?php

namespace App\Models;

use App\Models\pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = [
       
        'pegawai_nip',
        'username',
        'password',
        'role',
        'imgprofil'
    ];
    public function pegawai(){
        return $this->belongsTo(pegawai::class,'pegawai_nip','nip_baru');
    }
}