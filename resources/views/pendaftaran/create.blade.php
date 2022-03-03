@extends('layout')
@section('title', 'Tambah Pengunjung Baru')
@section('content')
<div class="container pt-3 d-flex flex-column align-items-center">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{route('pendaftaran.store')}}" method="post">
                @csrf
                <div class="card-header bg-secondary d-flex justify-content-between">
                    <span class="text-light h2">Form Pengunjung Baru</span>
                    <a href="{{route('pendaftaran.index')}}" class="btn btn-info">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" class="form-control @error('nama') border-danger @enderror">
                            @error('nama') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Tempat Lahir</label>
                        <div class="col-md-8">
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') border-danger @enderror">
                            @error('tempat_lahir') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') border-danger @enderror">
                            @error('tanggal_lahir') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Alamat</label>
                        <div class="col-md-8">
                            <textarea name="alamat" class="form-control @error('alamat') border-danger @enderror"></textarea>
                            @error('alamat') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') border-danger @enderror">
                                <option disabled selected>--Pilih Jenis Kelamin--</option>
                                <option>Pria</option>
                                <option>Wanita</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
