@extends('layouts.pdf')

@section('header')
    <table style="width: 100%">
        <tr>
            <td style="width: 15%" class="font-weight-bold">Siswa:</td>
            <td style="width: 50%">{{ $siswa->nama . ' - ' . $siswa->nisn }}</td>
            <td style="width: 15%" class="font-weight-bold">Tanggal Cetak:</td>
            <td style="width: 20%; text-align: right">{{ \Carbon\Carbon::now()->isoFormat('DD-MM-Y') }}</td>
        </tr>
    </table>
@endsection

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Bayar</th>
            <th scope="col">Bulan Dibayar</th>
            <th scope="col">Tahun Dibayar</th>
            <th scope="col">Nominal</th>
            <th scope="col">Petugas Penerima</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pembayarans as $pembayaran)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggalBayar)->isoFormat('DD-MM-Y') }}</td>
                <td>{{ $pembayaran->bulanBayar }}</td>
                <td>{{ $pembayaran->tahunBayar }}</td>
                <td>{{ "Rp" . number_format($pembayaran->jumlah,2,',','.') }}</td>
                <td>{{ $pembayaran->petugas?->nama }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
