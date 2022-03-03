@extends('layout')
@section('title', 'Instruktur')
@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success" role="alert" id="success-alert">
                <h4 class="alert-heading h5">Berhasil!</h4>
                <p>{{session('success')}}</p>
            </div>
            <script>
                setTimeout(function(){
                    document.getElementById('success-alert').remove()
                }, 2000);
            </script>
            @endif
            <div class="card">
                <div class="card-header bg-secondary d-flex justify-content-between">
                    <span class="text-light h2">Instruktur</span>
                    <div class="d-flex flex-wrap justify-content-end">
                        <form action="{{route('instruktur.index')}}">
                            <div class="form-group m-1 d-flex">
                                <input type="text" class="form-control mr-2" placeholder="Cari..." name="query">
                                <button class="btn btn-icon btn-info" type="submit">Cari</button>
                            </div>
                        </form>
                        <div class="form-group m-1">
                            <a href="{{route('instruktur.create')}}" class="btn btn-success">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped text-nowrap position-static">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Member</th>
                                    <th class="position-sticky bg-light" style="right:0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($instrukturs->count() < 1) <tr>
                                    <td colspan="9999">
                                        <h3 class="text-center">Data Kosong...</h3>
                                    </td>
                                    </tr>
                                    @endif
                                    @foreach ($instrukturs as $i => $instruktur)
                                    <tr>
                                        <td>{{$instruktur->hari}}</td>
                                        <td>{{$instruktur->nama}}</td>
                                        <td>{{$instruktur->alamat}}</td>
                                        <td>{{$instruktur->jenis_kelamin}}</td>
                                        <td>{{$instruktur->pengunjung->nama}}</td>
                                        <td class="position-sticky bg-light dropleft" style="right:0">
                                            <a class="btn bg-white btn-sm shadow-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink_{{$i}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Pilih
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{$i}}">
                                                <a href="{{route('instruktur.edit', $instruktur->id)}}" class="dropdown-item text-info">Edit</a>
                                                <a href="{{route('instruktur.confirm-delete', $instruktur->id)}}" class="dropdown-item text-warning">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$instrukturs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
