@extends('layout')
@section('title', 'Pengunjung')
@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-md-12">

            <div class="card border-dark">
                <div class="card-header bg-secondary d-flex justify-content-between">
                    <span class="text-light h2">Pengunjung</span>
                    <div class="d-flex flex-wrap justify-content-end">
                        <a href="{{route('laporan-pengunjung')}}" class="btn btn-dark mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                                <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                                <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                              </svg>
                              Laporan</a>
                        <form action="{{route('pendaftaran.index')}}">
                            <div class="form-group m-1 d-flex">
                                <input type="text" class="form-control mr-2" placeholder="Cari..." name="query" value="{{request('query')}}">
                                <button class="btn btn-icon btn-info" type="submit">Cari</button>
                            </div>
                        </form>
                        <div class="form-group m-1">
                            <a href="{{route('pendaftaran.create')}}" class="btn btn-success">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped text-nowrap position-static">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status Member</th>
                                    <th>Member Pada</th>
                                    <th>Member Berakhir Pada</th>
                                    <th class="position-sticky bg-light" style="right:0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pengunjungs->count() < 1) <tr>
                                    <td colspan="9999">
                                        <h3 class="text-center">Data Kosong...</h3>
                                    </td>
                                    </tr>
                                    @endif
                                    @foreach ($pengunjungs as $i => $pengunjung)
                                    <tr>
                                        <td>{{$pengunjung->nama}}</td>
                                        <td>{{$pengunjung->tempat_lahir}}</td>
                                        <td>{{$pengunjung->tanggal_lahir}}</td>
                                        <td>{{$pengunjung->alamat}}</td>
                                        <td>{{$pengunjung->jenis_kelamin}}</td>
                                        <td class="text-center">@if($pengunjung->member) <span class="text-light bg-success p-1 rounded shadow-sm text-nowrap">Member</span> @else <span class="text-muted text-nowrap">Bukan Member</span> @endif</td>
                                        <td>@if($pengunjung->member) <span class="text-light bg-info p-1 rounded shadow-sm text-nowrap">{{$pengunjung->member->created_at->diffForHumans()}}</span> @else <span class="text-muted">--</span> @endif</td>
                                        <td class="text-center">@if($pengunjung->member) <span class="text-light bg-info p-1 rounded shadow-sm text-wrap">{{$pengunjung->member->berakhir_pada->format('d M Y')}}</span> <span class="text-dark">{{$pengunjung->member->berakhir_pada->diffForHumans()}}</span> @else <span class="text-muted">--</span> @endif</td>
                                        <td class="position-sticky bg-light dropleft" style="right:0">
                                            <a class="btn bg-white btn-sm shadow-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink_{{$i}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Pilih
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{$i}}">
                                                <a href="{{route('pendaftaran.edit', $pengunjung->id)}}" class="dropdown-item text-info">Edit</a>
                                                @if($pengunjung->member) <a href="{{route('pendaftaran.confirm-delete-member', $pengunjung->id)}}" class="dropdown-item text-danger">Batalkan Member</a> @else
                                                <a href="{{route('pendaftaran.confirm-member', $pengunjung->id)}}" class="dropdown-item text-success">Jadikan Member</a> @endif
                                                <a href="{{route('pendaftaran.confirm-delete', $pengunjung->id)}}" class="dropdown-item text-warning">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$pengunjungs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
