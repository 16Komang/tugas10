<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            KelasSeeder::class,
            UpdateMahasiswaSeeder::class,
            MataKuliahSeeder::class,

        ]);
        
        Mahasiwa::create([
            'nim' => '20417200225',
            'nama' => 'Komang Gede Narariya S',
            'foto' => 'default.png',
            'kelas_id' => 5,
            'jurusan' => 'Teknologi Informasi',
            'email'=> 'suputrakomang22@gmail.com',
            'alamat'=> 'Tidar',
            'TTL' => 'ljg 22 oktober 2001'
            
        ]);
        $this->call([

            NilaiSeeder::class,
        ]);
    }
}
