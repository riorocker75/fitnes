@extends('layout')
@section('title', 'Tambah Transaksi Baru')
@section('content')
<div class="container pt-3 d-flex flex-column align-items-center">
    <div class="col-lg-8">
        <div class="card">
            <form action="{{route('transaksi.store')}}" method="post">
                @csrf
                <div class="card-header bg-secondary d-flex justify-content-between">
                    <span class="text-light h2">Form Transaksi Baru</span>
                    <a href="{{route('transaksi.index')}}" class="btn btn-info">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4">KODE TRANSAKSI</label>
                        <div class="col-md-8 d-flex align-items-center">
                            <input type="text" name="code_transaksi" class="form-control text-right @error('code_transaksi') border-danger @enderror">
                            @error('code_transaksi') <span class="text-danger">{{$message}}</span>@enderror
                            <span class="border rounded">{{now()->format('dmYhis')}}</span>
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
