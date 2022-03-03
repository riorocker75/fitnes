@extends('layout')
@section('title', 'Konfirmasi Hapus')
@section('content')
<div class="container pt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Peringatan...!</div>
                <div class="card-body">
                    Apakah Anda yakin ingin menghapus pengunjung dengan nama {{$pengunjung->nama}} ?
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{route('pendaftaran.index')}}" class="btn btn-info">Kembali</a>
                    <form action="{{route('pendaftaran.destroy', $pengunjung->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
