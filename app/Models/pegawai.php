<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
    protected $primaryKey = 'nip_baru';

    

	/**
	 * @return mixed
	 */
	public function getPrimaryKey() {
		return $this->primaryKey;
	}
	
	/**
	 * @param mixed $primaryKey 
	 * @return self
	 */
	public function setPrimaryKey($primaryKey): self {
		$this->primaryKey = $primaryKey;
		return $this;
	}
}
