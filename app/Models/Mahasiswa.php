<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Mahasiswa extends Model//definisi model
{
    protected $table='mahasiswa';//eloquent akan membuat model mahasiswa menyimpan record di table
    protected $primaryKey = 'Nim';//Memanggil isi DB Dengan primaryKey
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable=[
        'Nim',
        'Nama',
        'foto',
        'kelas_id',
        'Jurusan',
        'Email',
        'Alamat',
        'TTL',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
};