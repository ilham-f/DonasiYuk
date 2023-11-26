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
        // kesehatan
        // 1
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-15',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 2
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-16',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 3
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-17',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 4
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-18',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 5
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-19',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 6
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-20',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 7
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-21',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);
        // 8
        Program::create([
            'judul' => 'Mari Bantu Budi Berjuang Melawan Kanker',
            'deskripsi' => 'Budi anak berusia 6 tahun yang tinggal bersama neneknya di sebuah gubuk kecil, diketahui bahwa Budi sering terpapar asap rokok petani sejak kecil',
            'category_id' => 1,
            'user_id' => 1,
            'target' => 100000,
            'batastanggal' => '2024-06-22',
            'status' => '1',
            'image' => 'programs/Budi.png',
        ]);

        // pendidikan
        // 9
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-01',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 10
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-02',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 11
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-03',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 12
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-04',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 13
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-05',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 14
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-06',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 15
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-07',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);
        // 16
        Program::create([
            'judul' => 'Mari Bantu Adi Melanjutkan Pendidikannya',
            'deskripsi' => 'Adi anak yang putus sekolah karena harus bekerja menghidupi adiknya kini ingin melanjutkan pendidikannya sembari bekerja paruh waktu',
            'category_id' => 2,
            'user_id' => 2,
            'target' => 150000,
            'batastanggal' => '2024-07-08',
            'status' => '1',
            'image' => 'programs/Adi.png',
        ]);

        // bencana alam
        // 17
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-09',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 18
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-10',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 19
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-11',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 20
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-12',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 21
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-13',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 22
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-14',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 23
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-15',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
        // 24
        Program::create([
            'judul' => 'Mari Bantu Pengungsi yang Terdampak Erupsi Gunung Semeru',
            'deskripsi' => 'Gunung semeru kembali erupsi setelah sekian lama',
            'category_id' => 3,
            'user_id' => 3,
            'target' => 250000,
            'batastanggal' => '2024-08-16',
            'status' => '1',
            'image' => 'programs/Andi.png',
        ]);
    }
}
