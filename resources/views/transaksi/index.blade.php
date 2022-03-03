@extends('layout')
@section('title', 'Transaksi')
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
                    <span class="text-light h2">Transaksi</span>
                    <div class="d-flex flex-wrap justify-content-end">
                        <a href="{{route('transaksi.laporan')}}" class="btn btn-dark mx-2 my-1">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z" />
                                <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z" />
                                <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                            </svg>
                            <span>Laporan</span>
                        </a>
                        <form action="{{route('transaksi.index')}}">
                            <div class="form-group m-1 d-flex">
                                <input type="text" class="form-control mr-2" placeholder="Cari..." name="query" value="{{request('query')}}">
                                <button class="btn btn-icon btn-info" type="submit">Cari</button>
                            </div>
                        </form>
                        {{-- <div class="form-group m-1">
                            <a href="{{route('transaksi.create')}}" class="btn btn-success">Tambah</a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-stripped text-nowrap position-static">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pengunjung</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Bayar</th>
                                <th>Kembalian</th>
                                {{-- <th class="position-sticky bg-light" style="right:0">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if($transaksis->count() < 1) <tr>
                                <td colspan="9999">
                                    <h3 class="text-center">Data Kosong...</h3>
                                </td>
                                </tr>
                                @endif
                                @foreach ($transaksis as $i => $transaksi)
                                <tr>
                                    <td>{{$transaksi->kode_transaksi}}</td>
                                    <td>{{$transaksi->pengunjung->nama}}</td>
                                    <td>{{$transaksi->created_at->format('d M Y')}}</td>
                                    <td><div class="d-flex justify-content-between"><span>Rp. </span><span>{{number_format($transaksi->total_harga, 2, ',', '.')}}</span></div></td>
                                    <td><div class="d-flex justify-content-between"><span>Rp. </span><span>{{number_format($transaksi->bayar, 2, ',', '.')}}</span></div></td>
                                    <td><div class="d-flex justify-content-between"><span>Rp. </span><span>{{number_format($transaksi->kembalian, 2, ',', '.')}}</span></div></td>
                                    {{-- <td class="position-sticky bg-light dropleft" style="right:0">
                                            <a class="btn bg-white btn-sm shadow-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink_{{$i}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pilih
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{$i}}">
                                        <a href="{{route('transaksi.edit', $transaksi->id)}}" class="dropdown-item text-info">Edit</a>
                                        <a href="{{route('transaksi.confirm-delete', $transaksi->id)}}" class="dropdown-item text-warning">Hapus</a>
                                    </div>
                                    </td> --}}
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{$transaksis->links()}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
