<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Laporan Transaksi</title>
</head>

<body>
    <h1 class="text-center">Laporan Transaksi</h1>
    <div class="card rounded-0">
        <div class="card-header rounded-0 d-flex justify-content-between d-print-none">
            <span>Parameter Laporan</span>
            <a href="{{route('transaksi.index')}}" class="btn btn-dark">Kembali</a>
        </div>
        <form action="{{route('transaksi.laporan')}}">
            <div class="card-body rounded-0">
                <div class="d-flex flex-wrap justify-content-center">
                    <label class="mx-2">Dari Tanggal</label>
                    <div class="mx-2"><input type="date" name="dari_tanggal" class="form-control @error('dari_tanggal') border-danger @enderror" value="{{request('dari_tanggal')}}">
                        @error('dari_tanggal') <span class="text-danger"> {{$message}}</span>@enderror
                    </div>
                    <label class="mx-2">Sampai Tanggal</label>
                    <div class="mx-2"><input type="date" name="sampai_tanggal" class="form-control @error('sampai_tanggal') border-danger @enderror" value={{request('sampai_tanggal')}}>
                        @error('sampai_tanggal') <span class="text-danger"> {{$message}}</span>@enderror
                    </div>
                    <label class="mx-2">Jenis Transaksi</label>
                    <div class="mx-2">
                        <select name="transaksi" class="form-control @error('transaksi') border-danger @enderror">
                            <option value="TRM" {{request('member') == 'member' ? 'selected' : ''}}>Member</option>
                            <option value="ABSEN" {{request('absensi') == 'absensi' ? 'selected' : ''}}>Absensi</option>
                            <option value="SEMUA" {{request('semua') == 'semua' ? 'selected' : ''}}>Semua</option>
                        </select>
                        @error('transaksi') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <button class="btn btn-dark mx-2 d-print-none" type="submit">Buat Laporan</button>
                    <button class="btn btn-icon btn-info rounded-pill shadow-sm mx-2 d-print-none" onclick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                        <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                        <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                      </svg></button>
                </div>
            </div>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Pengunjung</th>
                <th>Tanggal Transaksi</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $key => $transaction)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$transaction->kode_transaksi}}</td>
                <td>{{$transaction->pengunjung->nama}}</td>
                <td>{{$transaction->created_at->format('d M Y')}}</td>
                <td><div class="d-flex justify-content-between"><span>Rp. </span><span>{{number_format($transaction->total_harga, 2, ',', '.')}}</span></div></td>
                <td><div class="d-flex justify-content-between"><span>Rp. </span><span>{{number_format($transaction->bayar, 2, ',', '.')}}</span></div></td>
                <td><div class="d-flex justify-content-between"><span>Rp. </span><span>{{number_format($transaction->kembalian, 2, ',', '.')}}</span></div></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">Total</td>
                <td><div class="d-flex justify-content-between"><span>Rp</span><span>{{number_format($transactions->sum('total_harga'), 2, ',', '.')}}</span></div></td>
                <td><div class="d-flex justify-content-between"><span>Rp</span><span>{{number_format($transactions->sum('bayar'), 2, ',', '.')}}</span></div></td>
                <td><div class="d-flex justify-content-between"><span>Rp</span><span>{{number_format($transactions->sum('kembalian'), 2, ',', '.')}}</span></div></td>
            </tr>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
