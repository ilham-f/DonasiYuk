<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doa;

class DoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doa::create([
            'doa' => 'Semoga Budi cepat sembuh, amiinn',
            'program_id' => 1,
            'user_id' => 1,
        ]);

        Doa::create([
            'doa' => 'Semoga Budi cepat sembuh, amiinn',
            'program_id' => 1,
            'user_id' => 2,
        ]);

        Doa::create([
            'doa' => 'Semoga Budi cepat sembuh, amiinn',
            'program_id' => 1,
            'user_id' => 3,
        ]);
    }
}
