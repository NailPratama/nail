<?php

namespace Database\Seeders;

use App\Models\CoverImage;
use Illuminate\Database\Seeder;
use SplPriorityQueue;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    
    public function run(){       
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\salazar.png");
            // CoverImage::create([
            //     "namagambar" => "salazar",
            //     "slug"=> "salazar",
            //     "pengunggah" => "Bill Salazar",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/salazar.png",
            //     "link" => "https://www.pexels.com/id-id/foto/kayu-pemandangan-air-jembatan-17836360/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\churchman.png");
            // CoverImage::create([
            //     "namagambar" => "churchman",
            //     "slug"=> "churchman",
            //     "pengunggah" => "Kellie Churchman",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/churchman.png",
            //     "link" => "https://www.pexels.com/id-id/foto/foto-pemandangan-perairan-1001682",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\laura.png");
            // CoverImage::create([
            //     "namagambar" => "laura",
            //     "slug"=> "laura",
            //     "pengunggah" => "Laura The Explaura",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/laura.png",
            //     "link" => "1",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\gradu.png");
            // CoverImage::create([
            //     "namagambar" => "gradu",
            //     "slug"=> "gradu",
            //     "pengunggah" => "Radu's Page Picture",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/gradu.png",
            //     "link" => "https://www.pexels.com/id-id/foto/beruang-panda-di-rumput-hijau-3608263/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\jutzeler.png");
            // CoverImage::create([
            //     "namagambar" => "jutzeler",
            //     "slug"=> "jutzeler",
            //     "pengunggah" => "Susanne Jutzeler",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/jutzeler.png",
            //     "link" => "https://www.pexels.com/id-id/foto/alam-kuning-kilang-bunga-17549286/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\kelly.png");
            // CoverImage::create([
            //     "namagambar" => "kelly",
            //     "slug"=> "kelly",
            //     "pengunggah" => "Kelly",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/kelly.png",
            //     "link" => "https://www.pexels.com/id-id/foto/taman-kilang-dedaunan-pertumbuhan-17506694/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\judy.png");
            // CoverImage::create([
            //     "namagambar" => "judy",
            //     "slug"=> "judy",
            //     "pengunggah" => "Judy Kim",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/judy.png",
            //     "link" => "www.pexels.com/id-id/foto/lukisan-abstrak-warna-warni-15105/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pazeta.png");
            // CoverImage::create([
            //     "namagambar" => "pazeta",
            //     "slug"=> "pazeta",
            //     "pengunggah" => "Lucas Pezeta",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/pazeta.png",
            //     "link" => "https://www.pexels.com/id-id/foto/gedung-tinggi-coklat-dan-beige-1996163/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\knop.png");
            // CoverImage::create([
            //     "namagambar" => "knop",
            //     "slug"=> "knop",
            //     "pengunggah" => "Stas Knop",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/knop.png",
            //     "link" => "https://www.pexels.com/id-id/foto/orang-yang-berjalan-dekat-gedung-bertingkat-1168746/",
            // ]);


            // // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\anete.png");
            // // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\anete.png");
            // // CoverImage::create([
            // //     "namagambar" => "anete",
            // //     "slug"=> "anete",
            // //     "pengunggah" => "2",
            // //     "lisensi" => "Public Domain",
            // //     "cap_all_RDE" => $cap_RDE[0],
            // //     "cap_locmap_RDE" => $cap_RDE[1],
            // //     "cap_payload_RDE" => $cap_RDE[2],
            // //     "cap_all_DE" => $cap_DE[0],
            // //     "cap_locmap_DE" => $cap_DE[1],
            // //     "cap_payload_DE" => $cap_DE[2],
            // //     "url_lokal" => "coverdata/anete.png",
            // //     "url_global" => "2",
            // // ]);

            // // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\berger.png");
            // // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\berger.png");
            // // CoverImage::create([
            // //     "namagambar" => "berger",
            // //     "slug"=> "berger",
            // //     "pengunggah" => "3",
            // //     "lisensi" => "Public Domain",
            // //     "cap_all_RDE" => $cap_RDE[0],
            // //     "cap_locmap_RDE" => $cap_RDE[1],
            // //     "cap_payload_RDE" => $cap_RDE[2],
            // //     "cap_all_DE" => $cap_DE[0],
            // //     "cap_locmap_DE" => $cap_DE[1],
            // //     "cap_payload_DE" => $cap_DE[2],
            // //     "url_lokal" => "coverdata/berger.png",
            // //     "url_global" => "3",
            // // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pixabay.png");
            // CoverImage::create([
            //     "namagambar" => "pixabay",
            //     "slug"=> "pixabay",
            //     "pengunggah" => "Pixabay",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/pixabay.png",
            //     "link" => "https://www.pexels.com/id-id/foto/pencakar-langit-di-city-against-sky-257856/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pasaric.png");
            // CoverImage::create([
            //     "namagambar" => "pasaric",
            //     "slug"=> "pasaric",
            //     "pengunggah" => "Aleksandar Pasaric",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/pasaric.png",
            //     "link" => "https://www.pexels.com/id-id/foto/foto-pencakar-langit-dikelilingi-awan-1437493/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\canary.png");
            // CoverImage::create([
            //     "namagambar" => "canary",
            //     "slug"=> "canary",
            //     "pengunggah" => "Oleksandr Canary Islands",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/canary.png",
            //     "link" => "https://www.pexels.com/id-id/foto/hutan-345522/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\div2.png");
            // CoverImage::create([
            //     "namagambar" => "div2",
            //     "slug"=> "div2",
            //     "pengunggah" => "Diverse Graphic",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/div2.png",
            //     "link" => "https://www.pexels.com/id-id/foto/pohon-di-siang-hari-297954/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\adil.png");
            // CoverImage::create([
            //     "namagambar" => "adil",
            //     "slug"=> "adil",
            //     "pengunggah" => "Adil",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/adil.png",
            //     "link" => "https://www.pexels.com/id-id/foto/foto-close-up-cewek-2695703/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\anete.png");
            // CoverImage::create([
            //     "namagambar" => "anete",
            //     "slug"=> "anete",
            //     "pengunggah" => "Anete Lusiana",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/anete.png",
            //     "link" => "https://www.pexels.com/id-id/foto/mainan-beruang-dan-benang-di-atas-meja-di-kamar-di-siang-hari-4792086/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\berger.png");
            // CoverImage::create([
            //     "namagambar" => "berger",
            //     "slug"=> "berger",
            //     "pengunggah" => "Simon Berger",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/berger.png",
            //     "link" => "https://www.pexels.com/id-id/foto/foto-snowy-field-3462588/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\goli.png");
            // CoverImage::create([
            //     "namagambar" => "goli",
            //     "slug"=> "goli",
            //     "pengunggah" => "Chalt Goli",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/goli.png",
            //     "link" => "https://www.pexels.com/id-id/foto/gedung-putih-dan-hitam-dekat-pohon-1797113/",
            // ]);

            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\laura.png");
            // CoverImage::create([
            //     "namagambar" => "laura",
            //     "slug"=> "laura",
            //     "pengunggah" => "1",
            //     "lisensi" => "Public Domain",
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "path" => "coverdata/laura.png",
            //     "link" => "1",
            // ]);

            $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\hristov.png");
            CoverImage::create([
                "namagambar" => "hristov",
                "slug"=> "hristov",
                "pengunggah" => "Tsvetoslav Hristov",
                "lisensi" => "Public Domain",
                "cap_all_DE" => $cap_DE[0],
                "cap_locmap_DE" => $cap_DE[1],
                "cap_payload_DE" => $cap_DE[2],
                "path" => "coverdata/hristov.png",
                "link" => "https://www.pexels.com/id-id/foto/pohon-di-bawah-watergrasspaont-2499862/",
            ]);

            $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\camacho.png");
            CoverImage::create([
                "namagambar" => "camacho",
                "slug"=> "camacho",
                "pengunggah" => "Viviana Camacho",
                "lisensi" => "Public Domain",
                "cap_all_DE" => $cap_DE[0],
                "cap_locmap_DE" => $cap_DE[1],
                "cap_payload_DE" => $cap_DE[2],
                "path" => "coverdata/camacho.png",
                "link" => "https://www.pexels.com/id-id/foto/air-di-bawah-gua-2432208/",
            ]);

            $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\mike].png");
            CoverImage::create([
                "namagambar" => "mike",
                "slug"=> "mike",
                "pengunggah" => "Mike Van Scoonderwalt",
                "lisensi" => "Public Domain",
                "cap_all_DE" => $cap_DE[0],
                "cap_locmap_DE" => $cap_DE[1],
                "cap_payload_DE" => $cap_DE[2],
                "path" => "coverdata/mike].png",
                "link" => "https://www.pexels.com/id-id/foto/air-di-bawah-gua-2432208/",
            ]);




            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\bubu.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\bubu.png");
            // CoverImage::create([
            //     "namagambar" => "bubu",
            //     "slug"=> "bubu",
            //     "pengunggah" => "4",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/bubu.png",
            //     "url_global" => "4",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\camacho.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\camacho.png");
            // CoverImage::create([
            //     "namagambar" => "camacho",
            //     "slug"=> "camacho",
            //     "pengunggah" => "",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],SS
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/camacho.png",
            //     "url_global" => "5",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\canary.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\canary.png");
            // CoverImage::create([
            //     "namagambar" => "canary",
            //     "slug"=> "canary",
            //     "pengunggah" => "6",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/canary.png",
            //     "url_global" => "6",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\churchman.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\churchman.png");
            // CoverImage::create([
            //     "namagambar" => "churchman",
            //     "slug"=> "churchman",
            //     "pengunggah" => "7",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/churchman.png",
            //     "url_global" => "7",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\ferro.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\ferro.png");
            // CoverImage::create([
            //     "namagambar" => "ferro",
            //     "slug"=> "ferro",
            //     "pengunggah" => "8",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/ferro.png",
            //     "url_global" => "8",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\goli.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\goli.png");
            // CoverImage::create([
            //     "namagambar" => "goli",
            //     "slug"=> "goli",
            //     "pengunggah" => "9",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/goli.png",
            //     "url_global" => "9",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\hristov.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\hristov.png");
            // CoverImage::create([
            //     "namagambar" => "hristov",
            //     "slug"=> "hristov",
            //     "pengunggah" => "10",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/hristov.png",
            //     "url_global" => "10",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\judy.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\judy.png");
            // CoverImage::create([
            //     "namagambar" => "judy",
            //     "slug"=> "judy",
            //     "pengunggah" => "11",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/judy.png",
            //     "url_global" => "11",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\jutzeler.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\jutzeler.png");
            // CoverImage::create([
            //     "namagambar" => "jutzeler",
            //     "slug"=> "jutzeler",
            //     "pengunggah" => "12",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/jutzeler.png",
            //     "url_global" => "12",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\kelly.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\kelly.png");
            // CoverImage::create([
            //     "namagambar" => "kelly",
            //     "slug"=> "kelly",
            //     "pengunggah" => "13",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/kelly.png",
            //     "url_global" => "13",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\keola.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\keola.png");
            // CoverImage::create([
            //     "namagambar" => "keola",
            //     "slug"=> "keola",
            //     "pengunggah" => "14",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/keola.png",
            //     "url_global" => "14",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\knop.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\knop.png");
            // CoverImage::create([
            //     "namagambar" => "knop",
            //     "slug"=> "knop",
            //     "pengunggah" => "15",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/knop.png",
            //     "url_global" => "15",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\laura.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\laura.png");
            // CoverImage::create([
            //     "namagambar" => "laura",
            //     "slug"=> "laura",
            //     "pengunggah" => "16",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/laura.png",
            //     "url_global" => "16",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\mike].png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\mike].png");
            // CoverImage::create([
            //     "namagambar" => "mike",
            //     "slug"=> "mike",
            //     "pengunggah" => "17",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/mike].png",
            //     "url_global" => "17",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\nizam.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\nizam.png");
            // CoverImage::create([
            //     "namagambar" => "nizam",
            //     "slug"=> "nizam",
            //     "pengunggah" => "18",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/nizam.png",
            //     "url_global" => "18",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\pasaric.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pasaric.png");
            // CoverImage::create([
            //     "namagambar" => "pasaric",
            //     "slug"=> "pasaric",
            //     "pengunggah" => "19",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/pasaric.png",
            //     "url_global" => "19",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\pazeta.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pazeta.png");
            // CoverImage::create([
            //     "namagambar" => "pazeta",
            //     "slug"=> "pazeta",
            //     "pengunggah" => "20",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/pazeta.png",
            //     "url_global" => "20",
            // ]);

            // $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\pixabay.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pixabay.png");
            // CoverImage::create([
            //     "namagambar" => "pixabay",
            //     "slug"=> "pixabay",
            //     "pengunggah" => "21",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/pixabay.png",
            //     "url_global" => "21",
            // ]);

            //  $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\pixabay2.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\pixabay2.png");
            // CoverImage::create([
            //     "namagambar" => "pixabay2",
            //     "slug"=> "pixabay2",
            //     "pengunggah" => "22",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/pixabay2.png",
            //     "url_global" => "22",
            // ]);

            //  $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\gradu.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\gradu.png");
            // CoverImage::create([
            //     "namagambar" => "radu",
            //     "slug"=> "radu",
            //     "pengunggah" => "23",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/gradu.png",
            //     "url_global" => "23",
            // ]);

            //  $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\salazar.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\salazar.png");
            // CoverImage::create([
            //     "namagambar" => "salazar",
            //     "slug"=> "salazar",
            //     "pengunggah" => "24",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/salazar.png",
            //     "url_global" => "24",
            // ]);

            //  $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\gtobi.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\gtobi.png");
            // CoverImage::create([
            //     "namagambar" => "gtobi",
            //     "slug"=> "gtobi",
            //     "pengunggah" => "25",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/gtobi.png",
            //     "url_global" => "25",
            // ]);

            //  $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\swift.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\swift.png");
            // CoverImage::create([
            //     "namagambar" => "swift",
            //     "slug"=> "swift",
            //     "pengunggah" => "26",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/swift.png",
            //     "url_global" => "26",
            // ]);

            //  $cap_RDE = $this->kapasitas_RDE(storage_path()."\app\public\coverdata\div2.png");
            // $cap_DE = $this->kapasitas_DE(storage_path()."\app\public\coverdata\div2.png");
            // CoverImage::create([
            //     "namagambar" => "div2",
            //     "slug"=> "div2",
            //     "pengunggah" => "27",
            //     "lisensi" => "Public Domain",
            //     "cap_all_RDE" => $cap_RDE[0],
            //     "cap_locmap_RDE" => $cap_RDE[1],
            //     "cap_payload_RDE" => $cap_RDE[2],
            //     "cap_all_DE" => $cap_DE[0],
            //     "cap_locmap_DE" => $cap_DE[1],
            //     "cap_payload_DE" => $cap_DE[2],
            //     "url_lokal" => "coverdata/div2.png",
            //     "url_global" => "27",
            // ]);




            
        }
        
        
        public function kapasitas_DE($url_lokal){
            $T = 0;
            global $P;
            $img = imagecreatefrompng($url_lokal);
            $width = imagesx($img);
            $height = imagesy($img);
            $coverdata = $this->getpixelimage($height, $width, $img);
            $h = $this->get_h($height, $width, $coverdata);
            $l = $this->get_l($height, $width, $coverdata);
            do{
                global $bitstream, $original_set;
                $original_set = $this->get_original_set($h, $l, $T);
                global $capacity;
                $capacity = $this->get_capacity($original_set);
                $location_map = $this->get_location_map($original_set);
                $LSB = $this->get_LSB($original_set, $h);
                
                
                $strlocmap = null;
                for ($i=0; $i < count($location_map); $i++) { 
                    $strlocmap .= implode('', $location_map[$i]);
                }
                $RLE_locmap = $this->RLE($strlocmap);
                $L= $this->huffman_compress($RLE_locmap);
                $length_L = $this->texttobinary(strlen($L));
                
                
                $RLE_C = $this->RLE($LSB);
                $C = $this->huffman_compress($RLE_C);
                $length_C = $this->texttobinary(strlen($C));
                
                
                $length_P = $this->texttobinary(strlen($P));
                
                
                $konjungsi = $this->texttobinary("&");
                $limitheader = $this->texttobinary("&&");
                $bitstream = $length_L.$konjungsi.$length_C.$konjungsi.$length_P.$limitheader.$L.$C.$P;
                
                if ($T > 255) {
                    if (strlen($bitstream) > $capacity) {
                        break;
                    }
                }
                $T+=51;
            }while (strlen($bitstream) > $capacity);
            $all_cap = $capacity;
            $cap_locmap = strlen($bitstream);
            $cap_payload = floor(($capacity - strlen($bitstream))/8);
            
            $return_DE = array($all_cap, $cap_locmap, $cap_payload);
            return $return_DE;
        }
        public function getpixelimage($height, $width, $image){
            for ($i=0; $i < $height; $i++) { 
                for ($j=0; $j <$width ; $j++) { 
                    $coverdata[$i][$j] = imagecolorat($image, $j, $i); 
                }
            }
            return $coverdata;
        }
        
        public function get_h($height, $width, $coverdata){
            for ($i=0; $i < $height; $i++) { 
                $x_virtual = 0;
                for ($j=0; $j + 1 < $width; $j+=2) { 
                    $x = ($coverdata[$i][$j] >> 16) &0xFF;
                    $y = ($coverdata[$i][$j + 1] >> 16) &0xFF;
                    $h[$i][$x_virtual] = $x - $y;
                    $x_virtual++;
                }
            }
            return $h;
        }
        
        public function get_l($height, $width, $coverdata){
            for ($i=0; $i < $height; $i++) { 
                $x_virtual = 0;
                for ($j=0; $j + 1 < $width; $j+=2) { 
                    $x = ($coverdata[$i][$j] >> 16) &0xFF;
                    $y = ($coverdata[$i][$j + 1] >> 16) &0xFF;
                    $l[$i][$x_virtual] = floor(($x + $y)/2);
                    $x_virtual++;
                }
            }
            return $l;
        }
        
        public function get_original_set($h, $l, $T){
            for ($i=0; $i < count($h); $i++) { 
                for ($j=0; $j < count($h[$i]) ; $j++) { 
                    $exp0 = 2 * $h[$i][$j] + 0;
                    $exp1 = 2 * $h[$i][$j] + 1;
                    $qualified = min(2 * (255 - $l[$i][$j]) , 2 * $l[$i][$j] + 1);
                    $chg0 = 2 * floor($h[$i][$j] / 2) + 0;
                    $chg1 = 2 * floor($h[$i][$j] / 2) + 1;
                    if (abs($exp0) <= $qualified && abs($exp1) <= $qualified) {
                        if ($h[$i][$j] == 0 || $h[$i][$j] == (-1)) {
                            $original_set[$i][$j] = "EZ";
                        }elseif (abs($h[$i][$j]) <= $T ) {
                            $original_set[$i][$j] = "EN1";
                        }else{
                            $original_set[$i][$j] = "EN2";
                        }
                    } elseif(abs($chg0) <= $qualified && abs($chg1) <= $qualified){
                        $original_set[$i][$j] = "CN";
                    } else{
                        $original_set[$i][$j] = "NC";
                    }
                }
            }
            return $original_set;
        }
        
        public function get_capacity($original_set){
            $EZ = 0;
            $EN1 = 0;
            $EN2 = 0;
            $CN = 0;
            for ($i=0; $i < count($original_set); $i++) { 
                for ($j=0; $j < count($original_set[$i]) ; $j++) { 
                    if ($original_set[$i][$j] == "EZ") {
                        $EZ++;
                    } elseif ($original_set[$i][$j] == "EN1") {
                        $EN1++;
                    } elseif ($original_set[$i][$j] == "EN2") {
                        $EN2++;
                    } elseif ($original_set[$i][$j] == "CN") {
                        $CN++;
                    }
                }
            }
            $capacity = $EZ + $EN1 + $EN2 + $CN;
            return $capacity;
        }
        
        public function get_location_map($original_set){
            for ($i=0; $i < count($original_set); $i++) { 
                for ($j=0; $j < count($original_set[$i]); $j++) { 
                    if ($original_set[$i][$j] == "EZ" || $original_set[$i][$j] == "EN1") {
                        $location_map[$i][$j] = 1;
                    } else{
                        $location_map[$i][$j] = 0;
                    }
                }
            }
            return $location_map;
        }
        
        public function get_LSB($original_set, $h){
            $LSB = null;
            for ($i=0; $i < count($original_set); $i++) { 
                for ($j=0; $j < count($original_set[$i]); $j++) { 
                    if ($original_set[$i][$j] == "EN2" || $original_set[$i][$j] == "CN") {
                        if ($h[$i][$j] != 1 && $h[$i][$j] != -2) {
                            $binary_h = decbin($h[$i][$j]);
                            $LSB .= substr($binary_h, strlen($binary_h) - 1, 1);
                        }
                    }
                }
            }
            return $LSB;
        }
        
        public function binarytotext($binary){
            $returntext = null;
            
            for ($i=0; $i + 6 < strlen($binary) ; $i+=7) { 
                
                $returntext .= pack('H*', dechex(bindec(substr($binary, $i, 7))));
            }
            return $returntext;
        }
        
        public function texttobinary($text){
            $characters = str_split($text);
            
            $binaryText = [];
            foreach ($characters as $character){
                $data = unpack('H*', $character);
                $binaryText[] = str_pad(base_convert($data[1], 16, 2), 7, "0", STR_PAD_LEFT);;
            }
            
            $binaryTextImplode = implode('', $binaryText);
            
            return $binaryTextImplode;
        }
        
        public function RLE($teks){
            $n = strlen($teks);
            $returntext = null;
            for ($i=0; $i < $n ; $i++) { 
                $count = 1;
                while ($i < ($n - 1) && substr($teks, $i, 1) == substr($teks, $i + 1, 1)) {
                    $count++;
                    $i++;
                }
                $returntext .= substr($teks, $i, 1).$count."|"; 
            }
            return $returntext;
        }
        
        function huffman_encode($symb2freq) {
            $heap = new SplPriorityQueue;
            $heap->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
            foreach ($symb2freq as $sym => $wt)
            $heap->insert(array($sym => ''), -$wt);
            
            while ($heap->count() > 1) {
                $lo = $heap->extract();
                $hi = $heap->extract();
                foreach ($lo['data'] as &$x)
                $x = '1'.$x;
                foreach ($hi['data'] as &$x)
                $x = '0'.$x;
                $heap->insert($lo['data'] + $hi['data'],
                $lo['priority'] + $hi['priority']);
            }
            $result = $heap->extract();
            return $result['data'];
        }
        
        function huffman_compress($txt){
            $arr_text = str_split($txt);
            $symb2freq = array_count_values(str_split($txt));
            $huff = $this->huffman_encode($symb2freq);
            $code = null;
            for($i=0;$i<count($arr_text);$i++){
                $code .= $huff[$arr_text[$i]]; 
            }
            $sym = null;
            foreach ($symb2freq as $key => $value) {
                $sym .= ($key." ".$symb2freq[$key]." ");
            }
            
            $sym = $this->texttobinary($sym."--");
            $result = $sym.$code;
            $length_result = $this->texttobinary(strlen($code)."--");
            $result = $length_result.$result;
            return $result;
        }
        
    }