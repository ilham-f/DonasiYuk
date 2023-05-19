<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'user_id' => 3,
            'program_id' => 1,
            'image' => 'Budi.png',
        ]);

        News::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'user_id' => 3,
            'program_id' => 2,
            'image' => 'Adi.png',
        ]);

        News::create([
            'judul' => 'Mari Bantu Andi Bertahan Hidup Setelah Rumah Kecilnya Tertimbun Longsor',
            'deskripsi' => 'Andi anak berusia 7 tahun yang tinggal bersama neneknya. Andi telah tinggal tanpa orang tua sejak umur 5 tahun dikarenakan orang tua Andi mengalami sebuah kecelakaan.',
            'user_id' => 3,
            'program_id' => 3,
            'image' => 'Andi.png',
        ]);

        News::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'user_id' => 3,
            'program_id' => 3,
            'image' => 'pengungsi.jpg',
        ]);
    }

}
