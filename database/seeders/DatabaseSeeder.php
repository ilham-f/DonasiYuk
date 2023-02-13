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
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProgramSeeder::class,
        ]);

        // $keluhans = Keluhan::all();

        // Obat::all()->each(function ($obat) use ($keluhans) {
        //     $obat->keluhans()->attach(
        //         $keluhans->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        // });

    }
}
