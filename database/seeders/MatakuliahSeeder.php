<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $matkul =[
            ['nama_matkul' => 'PBO',
            'sks'=>3,
            'jam'=>6,
            'semester'=>4,
        ],

        ['nama_matkul' => 'PWL',
            'sks'=>3,
            'jam'=>6,
            'semester'=>4,
        ],

        ['nama_matkul' => 'BDL',
            'sks'=>3,
            'jam'=>6,
            'semester'=>4,
        ],

        ['nama_matkul' => 'PBDL',
            'sks'=>3,
            'jam'=>6,
            'semester'=>4,
        ],
    ];

    DB::table('matakuliah')->insert($matkul);

}
    
}