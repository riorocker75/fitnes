@extends('layout')
@section('title', 'Edit Instruktur')
@section('content')
<div class="container pt-3 d-flex flex-column align-items-center">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{route('instruktur.update', $instruktur->id)}}" method="post">
                @method('patch')
                @csrf
                <div class="card-header bg-secondary d-flex justify-content-between">
                    <span class="text-light h2">Form Edit Instruktur {{$instruktur->nama}}</span>
                    <a href="{{route('instruktur.index')}}" class="btn btn-info">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" value="{{$instruktur->nama}}" class="form-control @error('nama') border-danger @enderror">
                            @error('nama') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select name="jenis_kelamin" value="{{$instruktur->jenis_kelamin}}" class="form-control @error('jenis_kelamin') border-danger @enderror">
                                <option disabled selected>--Pilih Jenis Kelamin--</option>
                                <option {{$instruktur->jenis_kelamin == 'Pria' ? 'selected' : ''}}>Pria</option>
                                <option {{$instruktur->jenis_kelamin == 'Wanita' ? 'selected' : ''}}>Wanita</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Hari</label>
                        <div class="col-md-8">
                            <select name="hari" value="{{$instruktur->hari}}" class="form-control @error('hari') border-danger @enderror">
                                <option {{$instruktur->hari == 'senin' ? 'selected' : ''}} value="senin">Senin</option>
                                <option {{$instruktur->hari == 'selasa' ? 'selected' : ''}} value="selasa">Selasa</option>
                                <option {{$instruktur->hari == 'rabu' ? 'selected' : ''}} value="rabu">Rabu</option>
                                <option {{$instruktur->hari == 'kamis' ? 'selected' : ''}} value="kamis">Kamis</option>
                                <option {{$instruktur->hari == 'jumat' ? 'selected' : ''}} value="jumat">Jumat</option>
                                <option {{$instruktur->hari == 'sabtu' ? 'selected' : ''}} value="sabtu">Sabtu</option>
                                <option {{$instruktur->hari == 'minggu' ? 'selected' : ''}} value="minggu">Minggu</option>
                            </select>
                            @error('hari') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Alamat</label>
                        <div class="col-md-8">
                            <textarea name="alamat" value="{{$instruktur->alamat}}" class="form-control @error('alamat') border-danger @enderror">{{$instruktur->alamat}}</textarea>
                            @error('alamat') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Member</label>
                        <div class="col-md-8">
                            <select name="pengunjung_id" value="{{$instruktur->pengunjung_id}}" class="form-control">
                                @foreach ($pengunjungs as $pengunjungs)
                                    <option value="{{$pengunjungs->id}}" {{$pengunjungs->id == $instruktur->pengunjung_id ? 'selected' : ''}}>{{$pengunjungs->nama}} - {{$pengunjungs->alamat}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
