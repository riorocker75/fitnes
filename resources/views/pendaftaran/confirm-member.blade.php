@extends('layout')
@section('title', 'Konfirmasi Member')
@section('content')
<div class="container pt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <form action="{{route('pendaftaran.add-to-member', $pengunjung->id)}}" method="post">
                    @csrf
                    <div class="card-header">Peringatan...!</div>
                    <div class="card-body">
                        Apakah Anda yakin ingin menjadikan pengunjung dengan nama <strong class="text-info">{{$pengunjung->nama}}</strong> sebagai <strong class="text-success">member</strong> ?

                        <div class="form-group row mt-3">
                            <label class="col-lg-4">Berapa Lama</label>
                            <div class="col-lg-8">
                                <select name="durasi" id="" class="form-control" onchange="getBiaya()">
                                    <option value="1">1 Bulan - Rp. 100.000,--</option>
                                    <option value="3">3 Bulan - Rp. 250.000,--</option>
                                    <option value="6">6 Bulan - Rp. 400.000,--</option>
                                    <option value="12">12 Bulan - Rp. 700.000,--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Biaya</label>
                            <div class="col-lg-8">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" name="biaya" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Bayar</label>
                            <div class="col-lg-8">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" name="bayar" onkeyup="getKembalian()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Kembalian</label>
                            <div class="col-lg-8"><input type="text" class="form-control" name="kembalian" readonly /></div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{route('pendaftaran.index')}}" class="btn btn-info">Kembali</a>
                        <button type="submit" class="btn btn-success" id="btn_simpan" disabled>Jadikan Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function getBiaya(){
        var durasi = document.getElementsByName('durasi')[0].value
        var biaya = null;
        switch(durasi){
            case '1':
                biaya = 100000;
                break;
            case '3':
                biaya = 250000;
                break;
            case '6':
                biaya = 400000;
                break;
            case '12':
                biaya = 700000;
                break;
        }
        document.getElementsByName('biaya')[0].value = biaya;
    }
    function getKembalian(){
        var btnSimpan = document.getElementById('btn_simpan');
        var biaya = document.getElementsByName('biaya')[0].value;
        var bayar = document.getElementsByName('bayar')[0].value;
        var btn
        var kembalian = bayar - biaya;
        document.getElementsByName('kembalian')[0].value = kembalian;
        if(kembalian < 0) btnSimpan.setAttribute('disabled', 'disabled')
        else btnSimpan.removeAttribute('disabled')
    }
    getBiaya()
</script>
@endsection
