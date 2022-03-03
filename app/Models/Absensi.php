<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    public $table = 'absensi';
    protected $guarded = [];

    public function pengunjung(){
    	return $this->belongsTo(App\Models\Pengunjung::class, 'pengunjung_id');
    }
}
