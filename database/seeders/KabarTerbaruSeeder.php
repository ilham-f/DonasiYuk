<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KabarTerbaru;

class KabarTerbaruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KabarTerbaru::create([
            'judulKabar' => 'Pasang infus persiapan kemoterapi',
            'detailKabar' => 'Budi akan segera menjalani kemoterapi dan sekarang dia harus dalam kondisi fit, mohon doanya agar Budi dapat segera sembuh',
            'program_id' => 1,
        ]);

        KabarTerbaru::create([
            'judulKabar' => 'Kemoterapi Pertama',
            'detailKabar' => 'Budi telah menjalani kemoterapi dan sekarang dia masih dalam kondisi yang sangat lemas, mohon doanya agar Budi dapat segera sembuh',
            'program_id' => 1,
        ]);

        KabarTerbaru::create([
            'judulKabar' => 'Pasang infus rawat inap',
            'detailKabar' => 'Setelah menjalani kemoterapi sekarang dia sedang dalam masa pemulihan dan akan segera pulang ke rumah, mohon doanya agar Budi dapat segera sembuh',
            'program_id' => 1,
        ]);
    }
}
