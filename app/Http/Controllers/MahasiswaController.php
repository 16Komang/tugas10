<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\Kelas;
use App\models\Mahasiswa_Matakuliah;
use Illuminate\Support\Facades\Storage;
use pdf;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *z
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        //fungsi eloquent menampilkan data menggunakan pagination
        $mahasiswa = Mahasiswa::paginate(5);//Mengambil semua isi tabel
        $posts = Mahasiswa::orderBy('Nim','asc')->paginate(6);
        return view('mahasiswa.index',compact('mahasiswa'));
        with('i',(request()->input('page',1)-1)*5);
    }


    public function create()
    {
        $kelas = Kelas::all();//mendapatkan data dari tabel kelas
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $validasi =  $request->validate([
            'Nim'=>'required',
            'Nama'=>'required',
            'foto'=> 'required',
            'Kelas'=>'required',
            'Jurusan'=>'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'TTL' => 'required',
        ]);
        if ($request->file('foto')) {
            $image_name         = $request->file('foto')->store('images', 'public');
            $mahasiswa->foto    = $image_name;
        }

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->kelas_id = $request->get('Kelas');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->ttl = $request->get('TTL');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi qloquent untuk menambahkan data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali dengan ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa Berhasil Ditambahkan');
    }

    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdaskan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        return view('mahasiswa.detail',['Mahasiswa' => $Mahasiswa]);
    }

    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = DB::table('mahasiswa')->where('nim',$Nim)->first();
        $kelas = Kelas::all();//medndapatkan data dari tabel kelas
        return view('mahasiswa.edit',compact('Mahasiswa','kelas'));
    }

    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim'=>'required',
            'Nama'=>'required',
            'foto'=> 'required',
            'Kelas'=>'required',
            'Jurusan'=>'required',
            'Email'=>'required',
            'Alamat'=>'required',
            'TTL'=>'required',
        ]);

        if ($request->file('foto')) {
            if ($mahasiswa->foto && file_exists(storage_path('app/public/' . $mahasiswa->foto))) {
                Storage::delete('public/' . $mahasiswa->foto);
            }
            $mahasiswa->foto    = $request->file('foto')->store('images', 'public');
        }
        
        $foto = $request->file('foto')->store('images', 'public');
        $data['foto'] = $foto;
        $mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->kelas_id = $request->get('Kelas');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->ttl = $request->get('TTL');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi qloquent untuk menambahkan data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali dengan ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa Berhasil Edit');
    }

    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success','Mahasiswa Berhasil Dihapus');
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswa = Mahasiswa::where('Nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('mahasiswa.index', compact('mahasiswa'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function nilai($id_mahasiswa)
    {
        $mhs = Mahasiswa_Matakuliah::with('matakuliah')->where("mahasiswa_id", $id_mahasiswa)->get();
        $mhs->mahasiswa = Mahasiswa::with('kelas')->where("nim", $id_mahasiswa)->first();
        return view('mahasiswa.nilai', compact('mhs'));
    }
    public function cetak_khs($nim)
    {
        $data = Mahasiswa::where('nim', $nim)->with(['kelas', 'khs.mataKuliah'])->first();
        $pdf = PDF::loadview('mahasiswa.cetak_khs', compact('data'));
        return $pdf->stream();
    }

};