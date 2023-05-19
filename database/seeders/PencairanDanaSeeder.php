<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PencairanDana;

class PencairanDanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PencairanDana::create([
            'jumlah' => 10000,
            'tujuan' => 'Memasang infus untuk persiapan kemoterapi',
            'tglcair' => '2023-04-21',
            'program_id' => 1,
        ]);

        PencairanDana::create([
            'jumlah' => 10000,
            'tujuan' => 'Kemoterapi pertama',
            'tglcair' => '2023-04-22',
            'bukti' => 'nota.png',
            'program_id' => 1,
        ]);

        PencairanDana::create([
            'jumlah' => 10000,
            'tujuan' => 'Pasang infus rawat inap',
            'tglcair' => '2023-04-23',
            'program_id' => 1,
        ]);

        PencairanDana::create([
            'jumlah' => 10000,
            'tujuan' => 'Memperbarui infus rawat inap',
            'tglcair' => '2023-04-24',
            'bukti' => 'nota.png',
            'program_id' => 1,
        ]);
    }
}
