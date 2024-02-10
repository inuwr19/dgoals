<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desc = 'Ekpresikan gaya terbaikmu selalu dengan hal yang positif. Sepatu MONARC siap mengawal hari positifmu,
        didesain oleh material pelapis yang lembut dan nyaman saat dipakai karena adanya teknologi Quickfit dan Ortflow
        membuat sepatu ini makin sempurna untukmu. Teknologi Cumulus Foam dan Ortshox membuat sepatu ini sangat ringan dan
        mengikuti kontur kaki saat dipakai. Sepatu ini bermaterial Sandwich, Knitting, PU Nosew, Compression Phylon, dan
        EVA. Hi #TeamOrtuseight. KETENTUAN BERBELANJA DI ORTUSEIGHT OFFICIAL SHOP : 1. Ketersediaan STOK
        sesuai dengan yang tertera di halaman produk. 2. Pembelian akan di proses 2x24 jam tidak termasuk Sabtu, Minggu,
        dan hari libur nasional. 3. Pembelian tidak dapat DIBATALKAN, DIKEMBALIKAN atau UBAH WARNA / MODEL / UKURAN atas
        alasan apapun kecuali kesalahan penjual yang salah mengirimkan barang atau barang yang diterima cacat. 4. Pegajuan
        komplain harus disertakan video unboxing saat barang diterima. 5. Operasional chat Senin-Jumat jam 09:00-15:00.
        Sabtu, Minggu dan hari libur nasional TUTUP. Dengan melakukan pembelian berarti pembeli telah setuju dengan
        ketentuan tersebut. Selamat berbelanja.';

        Product::create([
            'category_id' => 1,
            'name'        => 'Sepatu Futsal Jogosala Rampage',
            'thumbnail'   => '1.png',
            'price'       => 350000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Sepatu Mills Matera IN White/Blue',
            'thumbnail'   => '2.png',
            'price'       => 350000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Sepatu Futsal Catalyst Raiden IN Ortuseight',
            'thumbnail'   => '3.png',
            'price'       => 350000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => '910 Nineten HAZE VISION SE JKT Sepatu Lari',
            'thumbnail'   => '4.png',
            'price'       => 500000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Ortuseight Sepatu Futsal Mirage In Black/Gold',
            'thumbnail'   => '5.png',
            'price'       => 350000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 1,
            'name'        => 'Sepatu Futsal Volt In Ortuseight',
            'thumbnail'   => '6.png',
            'price'       => 350000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Sepatu Bola Aztec Fg Ortuseight',
            'thumbnail'   => '7.png',
            'price'       => 500000,
            'desc'        => $desc,
        ]);
        Product::create([
            'category_id' => 2,
            'name'        => 'Sepatu Bola Legion Unity FG',
            'thumbnail'   => '8.png',
            'price'       => 500000,
            'desc'        => $desc,
        ]);
    }
}
