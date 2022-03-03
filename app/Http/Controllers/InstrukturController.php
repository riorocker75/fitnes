<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\Pengunjung;

class InstrukturController extends Controller
{
    public function index()
    {
        $instrukturs = new Instruktur;
        if (request('query')) {
            $instrukturs = $instrukturs->where(function ($q) {
                $q->orWhere('hari', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('nama', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('alamat', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . request('query') . '%')
                    ->orWhere('pengunjung_id', 'LIKE', '%' . request('query') . '%');
            });
        }
        $instrukturs = $instrukturs->paginate(request('perpage') ?? 10);
        return view('instruktur.index', compact('instrukturs'));
    }
    public function create()
    {
        $pengunjungs = Pengunjung::has('member')->get();
        return view('instruktur.create', compact('pengunjungs'));
    }
    public function store()
    {
        $this->validateForm();
        Instruktur::create($this->getForm());
        return back()->with('success','Instruktur Berhasil ditambah');
    }
    public function edit(Instruktur $instruktur)
    {
        $pengunjungs = Pengunjung::has('member')->get();
        return view('instruktur.edit', compact('instruktur', 'pengunjungs'));
    }
    public function update(Instruktur $instruktur)
    {
        $this->validateForm($instruktur);
        $instruktur->update($this->getForm());
        return back()->with('success', 'Instruktur Berhasil diperbaharui');
    }
    public function destroy(Instruktur $instruktur)
    {
        $instruktur->delete();
        return back()->with('success', 'Instruktur Berhasil dihapus');
    }
    public function validateForm()
    {
        request()->validate([
            'hari' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'pengunjung_id' => 'sometimes|integer',
        ]);
    }
    public function getForm()
    {
        return request()->only(
            'hari',
            'nama',
            'alamat',
            'jenis_kelamin',
            'pengunjung_id',
        );
    }
}
