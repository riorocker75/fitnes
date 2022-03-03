<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;

class PengunjungController extends Controller
{
    public function validateForm()
    {
        request()->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);
    }

    public function getForm()
    {
        return request()->only(
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'jenis_kelamin',
        );
    }

    public function confirmDelete($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        return view('pendaftaran.confirm-delete', compact("pengunjung"));
    }

    public function confirmMember($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        return view('pendaftaran.confirm-member', compact("pengunjung"));
    }

    public function confirmDeleteMember($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        return view('pendaftaran.confirm-delete-member', compact("pengunjung"));
    }

    public function addToMember($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $harga_member = 0;

        switch (request()->durasi) {
            case '1':
                $harga_member = 100000;
                break;
            case '3':
                $harga_member = 250000;
                break;
            case '6':
                $harga_member = 400000;
                break;
            case '12':
                $harga_member = 700000;
                break;
        }

        $pengunjung->member()->create([
            'berakhir_pada' => now()->addMonths(request()->durasi),
        ]);

        $transaksi = $pengunjung->transaksi()->create([
            'kode_transaksi' => 'TRM',
            'total_harga' => $harga_member,
            'bayar' => request()->bayar,
            'kembalian' => request()->kembalian,
        ]);

        $transaksi->detail_transaksi()->create([
            'berapa_bulan_member' => request()->durasi,
            'harga' => $harga_member,
        ]);

        return redirect(route('pendaftaran.index'))->with('success', 'Pengunjung Berhasil dijadikan sebagai Member');
    }

    public function removeFromMember($id)
    {
        Pengunjung::findOrFail($id)->member()->delete();
        return redirect(route('pendaftaran.index'))->with('success', 'Pengunjung Berhasil dihapus dari Member');
    }

    public function index()
    {
        $pengunjungs = Pengunjung::with(['member' => function ($q) {
            $q->whereDate('berakhir_pada', '>=', now());
        }]);
        if (request('query')) {
            $pengunjungs = $pengunjungs->orWhere(function ($q) {
                $q
                    ->orWhere('nama', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('tempat_lahir', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('tanggal_lahir', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('alamat', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . request('query') . '%');
            });
        }
        $pengunjungs = $pengunjungs->latest();
        $pengunjungs = $pengunjungs->paginate();
        return view('pendaftaran.index', compact('pengunjungs'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store()
    {
        $this->validateForm();
        Pengunjung::create($this->getForm());
        return redirect(route('pendaftaran.index'))->with('success', 'Pengunjung Berhasil ditambah');
    }

    public function edit($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        return view('pendaftaran.edit', compact('pengunjung'));
    }

    public function update($id)
    {
        $this->validateForm();
        Pengunjung::findOrFail($id)->update($this->getForm());
        return redirect(route('pendaftaran.index'))->with('success', 'Pengunjung Berhasil diupdate');
    }

    public function destroy($id)
    {
        Pengunjung::findOrFail($id)->delete();
        return redirect(route('pendaftaran.index'))->with('success', 'Pengunjung Berhasil dihapus');
    }

    public function laporan()
    {
        $pengunjungs = Pengunjung::with('member')->get();
        return view('laporan-pengunjung', compact('pengunjungs'));
    }

    public function buatLaporan()
    {
        request()->validate([
            'dari_tanggal' => 'required',
            'sampai_tanggal' => 'required',
            'member' => 'required',
        ]);
        $pengunjungs = Pengunjung::with('member')->whereDate('created_at', '>=', request('dari_tanggal'))->whereDate('created_at', '<=', request('sampai_tanggal'));
        if(request('member') == 'member'){
            $pengunjungs = $pengunjungs->whereHas('member', function($q){
                $q->whereDate('berakhir_pada', '>=', request('sampai_tanggal'));
            });
        }else if(request('member') == 'non_member'){
            $pengunjungs = $pengunjungs->whereDoesntHave('member', function($q){
                $q->whereDate('berakhir_pada', '>=', now());
            });
        }
        $pengunjungs = $pengunjungs->get();
        return view('laporan-pengunjung', compact('pengunjungs'));
    }
}
