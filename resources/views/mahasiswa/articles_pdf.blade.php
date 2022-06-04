<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Artikel</h4>
    </center>

    <table class='table table-bordered' style="width:95%;margin:
0 auto;">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Isi</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $a)
                <tr>
                    <td>{{ $a->title }}</td>
                    <td>{{ $a->content }}</td>
                    <td><img width="100px" src="{{ storage_path('app/public/' . $a->featured_image) }}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html> 
 27  
prak10/resources/views/articles/edit.blade.php
@@ -0,0 +1,27 @@
@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="/articles/{{ $article->id }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" required="required" name="title"
                    value="{{ $article->title }}"></br>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" required="required" name="content"
                    value="{{ $article->content }}"></br>
            </div>
            <div class="form-group">
                <label for="image">Feature Image</label>
                <input type="file" class="form-control" required="required" name="image"
                    value="{{ $article->featured_image }}"></br>
                <img width="150px" src="{{ asset('storage/' . $article->featured_image) }}">
            </div>
            <button type="submit" class="btn btn-primary float-right">Ubah
                Data</button>
        </form>
    </div>
@endsection 