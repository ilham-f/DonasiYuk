<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donasi;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donasi::create([
            'user_id' => 1,
            'program_id' => 1,
            'jml_donasi' => 10000
        ]);

        Donasi::create([
            'user_id' => 1,
            'program_id' => 2,
            'jml_donasi' => 10000
        ]);

        Donasi::create([
            'user_id' => 1,
            'program_id' => 3,
            'jml_donasi' => 10000
        ]);

        Donasi::create([
            'user_id' => 2,
            'program_id' => 1,
            'jml_donasi' => 10000
        ]);

        Donasi::create([
            'user_id' => 3,
            'program_id' => 1,
            'jml_donasi' => 10000
        ]);

        Donasi::create([
            'user_id' => 4,
            'program_id' => 1,
            'jml_donasi' => 10000
        ]);

        Donasi::create([
            'user_id' => 5,
            'program_id' => 1,
            'jml_donasi' => 10000
        ]);
    }
}
