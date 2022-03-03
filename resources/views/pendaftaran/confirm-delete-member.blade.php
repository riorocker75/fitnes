@extends('layout')
@section('title', 'Konfirmasi Hapus Member')
@section('content')
<div class="container pt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Peringatan...!</div>
                <div class="card-body">
                    Apakah Anda yakin ingin <span class="text-danger">mengapus status member</span>  pada pengunjung dengan nama <strong class="text-info">{{$pengunjung->nama}}</strong> ?
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{route('pendaftaran.index')}}" class="btn btn-info">Kembali</a>
                    <form action="{{route('pendaftaran.remove-from-member', $pengunjung->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
