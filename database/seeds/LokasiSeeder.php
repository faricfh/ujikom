<?php

use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Provinsi;
use App\Kota;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinsiRow) {
            Provinsi::create([
                'id_provinsi' => $provinsiRow['province_id'],
                'nama' => $provinsiRow['province']
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsiRow['province_id'])->get();
            foreach ($daftarKota as $kotaRow) {
                Kota::create([
                    'id_provinsi' => $provinsiRow['province_id'],
                    'id_kota' => $kotaRow['city_id'],
                    'nama' => $kotaRow['city_name']
                ]);
            }
        }
    }
}
