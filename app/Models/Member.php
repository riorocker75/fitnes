<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $table='member';
    protected $guarded = [];
    protected $casts =[
        'created_at' => 'datetime:d M Y',
        'berakhir_pada' => 'datetime:d M Y',
    ];
    protected $with = ['pengunjung'];

    public function instruktur(){
    	return $this->hasOne(Instruktur::class, 'member_id');
    }
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'pengunjung_id');
    }
}
