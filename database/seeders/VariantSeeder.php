<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Variant::create(['variants_name'=>'Bawang Bombai']);
        Variant::create(['variants_name'=>'Bawang Merah']);
        Variant::create(['variants_name'=>'Bawang Putih Honan']);
        Variant::create(['variants_name'=>'Beras Medium']);
        Variant::create(['variants_name'=>'Beras Premium']);
        Variant::create(['variants_name'=>'Beras SPHP Bulog']);
        Variant::create(['variants_name'=>'Cabai Merah Besar']);
        Variant::create(['variants_name'=>'Cabai Merah Keriting']);
        Variant::create(['variants_name'=>'Cabai Rawit Hijau']);
        Variant::create(['variants_name'=>'Cabai Rawit Merah']);
        Variant::create(['variants_name'=>'Daging Ayam Kampung']);
        Variant::create(['variants_name'=>'Daging Ayam Ras']);
        Variant::create(['variants_name'=>'Daging Sapi Paha Belakang']);
        Variant::create(['variants_name'=>'Daging Sapi Paha Depan']);
        Variant::create(['variants_name'=>'Daging Sapi Sandung Lamur']);
        Variant::create(['variants_name'=>'Daging Sapi Tetelan']);
        Variant::create(['variants_name'=>'Garam Halus']);
        Variant::create(['variants_name'=>'Gula Pasir Curah']);
        Variant::create(['variants_name'=>'Gula Pasir Kemasan']);
        Variant::create(['variants_name'=>'Ikan Teri']);
        Variant::create(['variants_name'=>'Ikan Tongkol']);
        Variant::create(['variants_name'=>'Jeruk Lokal']);
        Variant::create(['variants_name'=>'Kacang Hijau']);
        Variant::create(['variants_name'=>'Kacang Panjang']);
        Variant::create(['variants_name'=>'Kacang Tanah']);
        Variant::create(['variants_name'=>'Kangkung']);
        Variant::create(['variants_name'=>'Kedelai Impor']);
        Variant::create(['variants_name'=>'Kentang Sedang']);
        Variant::create(['variants_name'=>'Ketela Pohon']);
        Variant::create(['variants_name'=>'Ketimun Sedang']);
        Variant::create(['variants_name'=>'Mie Instan']);
        Variant::create(['variants_name'=>'Minyak Goreng Curah']);
        Variant::create(['variants_name'=>'Minyak Goreng Kemasan']);
        Variant::create(['variants_name'=>'Minyakita']);
        Variant::create(['variants_name'=>'Pisang Lokal']);
        Variant::create(['variants_name'=>'Sawi Hijau']);
        Variant::create(['variants_name'=>'Susu Bubuk']);
        Variant::create(['variants_name'=>'Susu Bubuk Balita']);
        Variant::create(['variants_name'=>'Susu Kental Manis']);
        Variant::create(['variants_name'=>'Tahu Putih']);
        Variant::create(['variants_name'=>'Telur Ayam Kampung']);
        Variant::create(['variants_name'=>'Telur Ayam Ras']);
        Variant::create(['variants_name'=>'Tempe Bungkus']);
        Variant::create(['variants_name'=>'Tepung Terigu']);
        Variant::create(['variants_name'=>'Tomat']);
        Variant::create(['variants_name'=>'Udang Basah']);
    }
}
