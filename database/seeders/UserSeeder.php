<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        // Pengunjung
        User::create([
            'nama' => 'ilham',
            'password' => Hash::make('ilham'),
            'email' => 'ilham@gmail.com',
        ]);

        User::create([
            'nama' => 'Ina',
            'password' => Hash::make('Ina'),
            'email' => 'Ina@gmail.com',
        ]);

        User::create([
            'nama' => 'Amel',
            'password' => Hash::make('Amel'),
            'email' => 'Amel@gmail.com',
        ]);

        User::create([
            'nama' => 'Hussein',
            'password' => Hash::make('Hussein'),
            'email' => 'Hussein@gmail.com',
        ]);

        User::create([
            'nama' => 'Fiki',
            'password' => Hash::make('Fiki'),
            'email' => 'Fiki@gmail.com',
        ]);

        // Admin
        User::create([
            'nama' => 'Zulfan',
            'password' => Hash::make('Zulfan'),
            'email' => 'Zulfan@gmail.com',
        ]);

        User::create([
            'nama' => 'Evan',
            'password' => Hash::make('Evan'),
            'email' => 'Evan@gmail.com',
        ]);

        User::create([
            'nama' => 'Bayu',
            'password' => Hash::make('Bayu'),
            'email' => 'Bayu@gmail.com',
        ]);

        User::create([
            'nama' => 'Rio',
            'password' => Hash::make('Rio'),
            'email' => 'Rio@gmail.com',
        ]);

        User::create([
            'nama' => 'Umiks',
            'password' => Hash::make('Umiks'),
            'email' => 'Umiks@gmail.com',
        ]);
    }
}
