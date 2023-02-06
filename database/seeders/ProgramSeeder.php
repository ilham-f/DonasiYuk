<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::create([
            'nama' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 7 tahun yang tinggal bersama neneknya. Budi telah tinggal tanpa orang tua sejak umur 5 tahun dikarenakan orang tua Budi mengalami sebuah kecelakaan.',
            'category_id' => 2,
            'user_id' => 1,
            'target' => 100000,
            'danaterkumpul' => 150000,
            'batastanggal' => 2024-01-01,
            'image' => 'Budi.png'
        ]);

        Program::create([
            'nama' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak berusia 7 tahun yang tinggal bersama neneknya. Adi telah tinggal tanpa orang tua sejak umur 5 tahun dikarenakan orang tua Adi mengalami sebuah kecelakaan.',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'danaterkumpul' => 150000,
            'batastanggal' => 2024-01-01,
            'image' => 'Adi.png'
        ]);

        Program::create([
            'nama' => 'Mari Bantu Andi Bertahan Hidup Setelah Rumah Kecilnya Tertimbun Longsor',
            'deskripsi' => 'Andi anak berusia 7 tahun yang tinggal bersama neneknya. Andi telah tinggal tanpa orang tua sejak umur 5 tahun dikarenakan orang tua Andi mengalami sebuah kecelakaan.',
            'category_id' => 3,
            'user_id' => 1,
            'target' => 100000,
            'danaterkumpul' => 150000,
            'batastanggal' => 2024-01-01,
            'image' => 'Andi.png'
        ]);
    }
}
