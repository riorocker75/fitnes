@extends('layout')
@section('title', 'Bayar Absensi')
@section('content')
<div class="container pt-3 d-flex flex-column align-items-center">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{route('absensi.update', $pengunjung->id)}}" method="post">
                @method('patch')
                @csrf
                <div class="card-header bg-secondary d-flex justify-content-between">
                    <span class="text-light h2">Transaksi Absen {{$pengunjung->nama}}</span>
                    <a href="{{route('absensi.index')}}" class="btn btn-info">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" value="{{$pengunjung->nama}}" class="form-control @error('nama') border-danger @enderror">
                            @error('nama') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Tanggal</label>
                        <div class="col-md-8">
                            <input type="date" name="tanggal" value="{{$request['tanggal']}}" class="form-control @error('tanggal') border-danger @enderror">
                            @error('tanggal') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Jam Masuk</label>
                        <div class="col-md-8">
                            <input onkeyup="getBiaya()" type="time" name="jam_masuk" value="{{$request['jam_masuk']}}" class="form-control @error('jam_masuk') border-danger @enderror">
                            @error('jam_masuk') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Jam Keluar</label>
                        <div class="col-md-8">
                            <input onkeyup="getBiaya()" type="time" name="jam_keluar" value="{{$request['jam_keluar']}}" class="form-control @error('jam_keluar') border-danger @enderror">
                            @error('jam_keluar') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    @if($pengunjung->member)
                    <div class="alert alert-success text-center"><h2>Member</h2></div>
                    @else
                    <div class="form-group row">
                        <label class="col-md-4">Biaya</label>
                        <div class="col-md-8">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input name="biaya" type="text" class="form-control" placeholder="00" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Bayar</label>
                        <div class="col-md-8">
                            <input onkeyup="getKembalian()" type="text" name="bayar" value="{{$pengunjung->absensi()->firstOrNew()->bayar}}" class="form-control @error('bayar') border-danger @enderror">
                            @error('bayar') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Kembalian</label>
                        <div class="col-md-8">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input name="kembalian" type="text" class="form-control" placeholder="00" readonly>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit" id="btn_simpan" {{$pengunjung->member ? '' : 'disabled'}}>Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function getBiaya(){
        var tanggal = "{{$request['tanggal']}}";
        var jam_masuk = Date.parse(tanggal+" "+document.getElementsByName('jam_masuk')[0].value);
        var jam_keluar = Date.parse(tanggal+" "+document.getElementsByName('jam_keluar')[0].value);
        var selisih = jam_keluar - jam_masuk;
        var hasil = new Date();
        hasil.setTime(selisih);
        hasil = (hasil.getUTCHours() * 60) + hasil.getUTCMinutes();
        var biaya = Math.round(hasil/60) * 10000;
        document.getElementsByName('biaya')[0].value = biaya;
    }
    function getKembalian(){
        var bayar = document.getElementsByName('bayar')[0].value;
        var biaya = document.getElementsByName('biaya')[0].value;
        var kembalian = parseInt(bayar) - parseInt(biaya);
        document.getElementsByName('kembalian')[0].value = kembalian;
        var btnSimpan = document.getElementById('btn_simpan')
        if(kembalian < 0) btnSimpan.setAttribute('disabled', 'disabled');
        else btnSimpan.removeAttribute('disabled');
    }
    getBiaya();
</script>
@endsection
