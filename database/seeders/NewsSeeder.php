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
            'konten' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'user_id' => 6,
            'category_id' => 1,
            'image' => 'programs/Budi.png',
        ]);

        News::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'konten' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'user_id' => 7,
            'category_id' => 2,
            'image' => 'programs/Adi.png',
        ]);

        News::create([
            'judul' => 'Mari Bantu Andi Bertahan Hidup Setelah Rumah Kecilnya Tertimbun Longsor',
            'konten' => 'Andi anak berusia 7 tahun yang tinggal bersama neneknya. Andi telah tinggal tanpa orang tua sejak umur 5 tahun dikarenakan orang tua Andi mengalami sebuah kecelakaan.',
            'user_id' => 8,
            'category_id' => 3,
            'image' => 'programs/Andi.png',
        ]);

        News::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'konten' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'user_id' => 9,
            'category_id' => 3,
            'image' => 'programs/pengungsi.jpg',
        ]);
    }

}
