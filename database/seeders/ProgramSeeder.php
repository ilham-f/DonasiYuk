<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

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
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 2,
            'user_id' => 1,
            'target' => 100000,
            'danaterkumpul' => 150000,
            'batastanggal' => '2023-03-05',
            'image' => 'Budi.png'
        ]);

        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 1,
            'user_id' => 2,
            'target' => 150000,
            'danaterkumpul' => 150000,
            'batastanggal' => '2023-03-04',
            'image' => 'Adi.png'
        ]);

        Program::create([
            'judul' => 'Mari Bantu Andi Bertahan Hidup Setelah Rumah Kecilnya Tertimbun Longsor',
            'deskripsi' => 'Andi anak berusia 7 tahun yang tinggal bersama neneknya. Andi telah tinggal tanpa orang tua sejak umur 5 tahun dikarenakan orang tua Andi mengalami sebuah kecelakaan.',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 200000,
            'danaterkumpul' => 150000,
            'batastanggal' => '2023-03-03',
            'image' => 'Andi.png'
        ]);

        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'danaterkumpul' => 150000,
            'batastanggal' => '2023-03-02',
            'image' => 'pengungsi.jpg'
        ]);

        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'danaterkumpul' => 150000,
            'batastanggal' => '2023-03-01',
            'image' => 'pengungsi.jpg'
        ]);
    }
}
