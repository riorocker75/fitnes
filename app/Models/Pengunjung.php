<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    public $table = 'pengunjung';
    protected $guarded = [];

    public function member()
    {
        return $this->hasOne(Member::class, 'pengunjung_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pengunjung_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'pengunjung_id');
    }

}
