<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::has('pengunjung');
        if (request('query')) {
            $transaksis = $transaksis->where(function ($q) {
                $q->orWhere('kode_transaksi', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('total_harga', 'LIKE', '%' . request('query') . '%');
            })->orWhereHas('pengunjung', function($q){
                $q->where('nama', 'LIKE', '%'.request('query').'%');
            });
        }

        $transaksis = $transaksis->latest();
        $transaksis = $transaksis->paginate(request('perpage') ?? 10);
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create');
    }
    public function laporan()
    {
        $transactions = Transaksi::has('pengunjung');
        if(request('dari_tanggal')){
         $transactions = $transactions->whereDate('created_at', '>=', request('dari_tanggal'));
        }
        if(request('sampai_tanggal')){
         $transactions = $transactions->whereDate('created_at', '<=', request('sampai_tanggal'));
        }
        if(request('transaksi')){
            $transactions = request('transaksi') == 'SEMUA' ? $transactions : $transactions->whereKodeTransaksi(request('transaksi'));
        }
        $transactions = $transactions->get();
        return view('laporan-transaksi', compact('transactions'));
    }
}
