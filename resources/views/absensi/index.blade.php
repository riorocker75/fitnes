@extends('layout')
@section('title', 'Absensi')
@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary d-flex justify-content-between flex-wrap">
                    <span class="text-light h2">Absensi</span>
                    <div class="d-flex flex-wrap justify-content-end">
                        <form action="{{route('absensi.index')}}" class="d-flex flex-wrap">
                            <div class="form-group m-1 text-nowrap d-flex ">
                                <label class="mx-1 text-white">Tanggal : </label>
                                <input type="date" class="form-control" name="tanggal" value="{{request('tanggal') ?? now()->format('Y-m-d')}}">
                            </div>
                            <div class="form-group m-1 d-flex">
                                <input type="text" class="form-control" placeholder="Cari..." name="query" value="{{request('query')}}">
                                <button class="btn btn-info ml-2" type="submit">Cari</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped text-nowrap position-static">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengunjungs as $keyP => $pengunjung)
                                <tr>
                                    <form action="{{route('absensi.edit', $pengunjung->id)}}" method="post">
                                        @csrf
                                        <td>{{$pengunjung->nama}}</td>
                                        <td>{{$pengunjung->alamat}}</td>
                                        <td>
                                            {{$pengunjung->absensi()->firstOrNew()->tanggal ?? (request('tanggal') ?? now()->format('Y-m-d'))}}
                                            <input type="hidden" name="tanggal" value="{{$absensi->tanggal ?? (request('tanggal') ?? now()->format('Y-m-d'))}}">
                                        </td>
                                        <td><input type="time" name="jam_masuk" class="form-control" value="{{$pengunjung->absensi()->firstOrNew()->jam_masuk}}" @if($pengunjung->absensi->count() > 0) disabled @endif></td>
                                        <td><input type="time" name="jam_keluar" class="form-control" value="{{$pengunjung->absensi()->firstOrNew()->jam_keluar}}"  @if($pengunjung->absensi->count() > 0) disabled @endif></td>
                                        <td>@if($pengunjung->absensi->count() < 1)<button type="submit" class="btn btn-secondary">Simpan</button>@endif</td>
                                    </form>
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
