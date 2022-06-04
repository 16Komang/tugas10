@extends('mahasiswa.layout')
@section('content')

<div class="container mt-3">
    <h3 class="text-center mb-5">JURUSAN TEKNOLOGI INFORMASI - POLITEKNIK NEGERI MALANG</h3>
    <h2 class="text-center mb-5">KARTU HASIL STUDI (KHS)</h2>

    <br><br><br>

    <b>Nama :</b> {{$mhs->mahasiswa->nama}} <br>
    <b>NIM  :</b> {{$mhs->mahasiswa->Nim}}  <br>
    <b>Kelas:</b> {{$mhs->mahasiswa->kelas->nama_kelas}}  <br>

    <br>
    <table class="table table_borderes">
        <tr>
            <th>Matakuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
        @foreach ($mhs as $n)
        <tr>
            <td>{{$n->matakuliah->nama_matkul}}</td>
            <td>{{$n->matakuliah->sks}}</td>
            <td>{{$n->matakuliah->semester}}</td>
            <td>{{$n->nilai}}</td>
        </tr>
        @endforeach
    </table>
    <div class="row">
        <div style="margin:0px 0px 0px 70px;">
            <a class="btn btn-success" href="{{ route('cetak_pdf') }}">Cetak PDF</a>
        </div>
    </div>
</div>
@endsection