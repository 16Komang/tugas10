@extends('mahasiswa.layout')

@section('content')
 <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div class="float-right my-2">
            <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
        </div>
    </div>
 </div>
 
 <form class="form" method="get" action="{{ route('search') }}">
    <div class="form-group w-100 mb-3">
        <label for="search" class="d-block mr-2">Search Form</label>
        <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Search your data...">
        <button type="submit" class="btn btn-primary mb-1">Cari</button>
    </div>
    <table class="mt-3 table table-bordered" style="width:95%;margin: 0 auto;">
 </form>

 @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
 @endif

 <table class="table table-bordered">
    <tr>
    <th>Nim</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Foto Mahasiswa</th>
        <th>Jurusan</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>TTL</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($mahasiswa as $mhs)
        <tr>
            <td>{{ $mhs->nim }}</td>
            <td>{{ $mhs->nama }}</td>
            <td><img src="{{ asset('storage/'.$mhs -> foto) }}" alt="" height="150px" width="150px" class="rounded" style="object-fit: cover"></td>
            <td>{{ $mhs->kelas->nama_kelas }}</td>
            <td>{{ $mhs->jurusan }}</td>
            <td>{{ $mhs ->email }}</td>
            <td>{{ $mhs ->alamat }}</td>
            <td>{{ $mhs ->ttl }}</td>
            <td>
            <form action="{{ route('mahasiswa.destroy',['mahasiswa'=>$mhs->nim]) }}" method="POST">

                <a class="btn btn-info" href="{{ route('mahasiswa.show',$mhs->nim) }}">Show</a>
                
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mhs->nim) }}">Edit</a>

                <a class="btn btn-warning" href="{{route('nilai', $mhs->nim)}}">Nilai</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
 </table>
        Halaman : {{ $mahasiswa->currentPage() }} <br/>
        Jumlah Data : {{ $mahasiswa->total() }} <br/>
        Data Per Halaman : {{ $mahasiswa->perPage() }} <br/>
        <br>{{ $mahasiswa->links() }}</br>
 @endsection