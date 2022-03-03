<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'transaksi';
    protected $with = ['pengunjung'];
    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
    public function pengunjung()
    {
        return $this->belongsTo(Pengunjung::class, 'pengunjung_id');
    }
}
