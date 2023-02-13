<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'ilham',
            'password' => 'ilham',
            'email' => 'ilham@gmail.com',
        ]);

        User::create([
            'nama' => 'Ina',
            'password' => 'Ina',
            'email' => 'Ina@gmail.com',
        ]);

        User::create([
            'nama' => 'Amel',
            'password' => 'Amel',
            'email' => 'Amel@gmail.com',
        ]);
    }
}
