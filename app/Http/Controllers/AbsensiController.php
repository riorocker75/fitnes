<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pengunjung;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengunjungs = Pengunjung::with(['member' => function ($q) {
            $q->whereDate('berakhir_pada', '>=', now());
        }, 'absensi' => function ($q) {
            $q->whereDate('tanggal', request('tanggal') ?? now());
        }]);
        if (request('tanggal')) {
            $pengunjungs = $pengunjungs->whereHas('absensi', function ($q) {
                $q->whereDate('tanggal', request('tanggal'))->latest();
            })->orWhereDoesntHave('absensi');
        }
        if (request('query')) {
            $pengunjungs = $pengunjungs->where(function ($q) {
                $q
                    ->orWhere('nama', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('tempat_lahir', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('tanggal_lahir', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('alamat', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . request('query') . '%');
            });
        }
        $pengunjungs = $pengunjungs->paginate(request('perpage') ?? 10);
        return view('absensi.index', compact('pengunjungs'));
    }
    public function edit($pengunjung)
    {
        $pengunjung = Pengunjung::with(['absensi' => function ($q) {
            $q->whereDate('tanggal', request()->tanggal)->firstOrNew();
        }])->find($pengunjung);
        $request = request()->all();
        return view('absensi.edit', compact('pengunjung', 'request'));
    }
    public function update($pengunjung)
    {
        $pengunjung = Pengunjung::with(['member' => function ($q) {
            $q->whereDate('berakhir_pada', '>=', now());
        }])->findOrFail($pengunjung);
        $pengunjung->absensi()->create([
            'tanggal' => request()->tanggal,
            'jam_masuk' => request()->jam_masuk,
            'jam_keluar' => request()->jam_keluar,
        ]);
        if ($pengunjung->member) {
        } else {
            $pengunjung->transaksi()->create([
                'kode_transaksi' => 'ABSEN',
                'total_harga' => request()->biaya,
                'bayar' => request()->bayar,
                'kembalian' => request()->kembalian,
            ]);
        }
        return redirect(route('absensi.index'))->with('success', 'Absensi berhasil diupdate');
    }
}
