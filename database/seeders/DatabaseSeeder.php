<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keluhan;
use App\Models\Obat;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            ProgramSeeder::class,
        ]);

        $keluhans = Keluhan::all();

        Obat::all()->each(function ($obat) use ($keluhans) {
            $obat->keluhans()->attach(
                $keluhans->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}
