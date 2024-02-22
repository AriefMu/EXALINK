<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailpeminjamanruang extends Model
{
    use HasFactory;
    protected $table = 'detailpeminjamanruang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namakeg',
        'mulai',
        'selesai',
        'approvedby',
        'alasan'
        
    ];
    

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
