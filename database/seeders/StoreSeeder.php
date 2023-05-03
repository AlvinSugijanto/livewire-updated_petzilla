<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

class StoreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function __construct()
    {
        $this->kabupaten = new Kabupaten();
        $this->kecamatan = new Kecamatan();
    }
    public function geocode($randomProv)
    {
        $kabupaten = $this->kabupaten->getKabupatenFromProvinsi($randomProv);
        $randomKab = $kabupaten[array_rand($kabupaten, 1)];

        $kecamatan = $this->kecamatan->getKecamatanFromKabupaten($randomKab['id']);
        $randomKec = $kecamatan[array_rand($kecamatan, 1)];

        $nama_kabupaten = $this->kabupaten->getNama($randomProv, $randomKab['id']);
        $nama_kecamatan = $this->kecamatan->getNama($randomKab['id'], $randomKec['id']);
        
        $temp = explode(" ", $nama_kabupaten);
        $kabupaten_name = implode(" ", array_slice($temp, 1));
        $getLatLng = Http::get('https://geocode.maps.co/search?q='.$nama_kecamatan.', '.$kabupaten_name)->json();

        return [
            'randomKab' => $randomKab,
            'randomKec' => $randomKec,
            'getLatLng' => $getLatLng
        ];
    }
    public function run($id_user, $counter)
    {
        $faker = Faker::create('id_ID');
        $randomProv = rand(31,36);
        // $provinsi = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $provinsi = array_shift($provinsi);
        // $randomProv = $provinsi[array_rand($provinsi, 1)];

        $geo_data = $this->geocode($randomProv);

        while(empty($geo_data['getLatLng'])){
            $geo_data = $this->geocode($randomProv);
        }

        $id_store = Str::random(10);
        $store = DB::table('store')->insert([
            'id_store' => $id_store,
            'nama_toko' => $faker->company,
            'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'alamat_lengkap' => $faker->address,
            'no_hp' => $faker->phoneNumber,
            'provinsi' => $randomProv,
            'kabupaten' => $geo_data['randomKab']['id'],
            'kecamatan' => $geo_data['randomKec']['id'],
            'latitude'=> $geo_data['getLatLng'][0]['lat'],
            'longitude' => $geo_data['getLatLng'][0]['lon'],
            'user_id_user' => $id_user
        ]);    

        for($i=0; $i<5; $i++)
        {
            $array = ['Kucing','Anjing'];
            $rand = array_rand($array);
            $z = $array[$rand];

            DB::table('list_animal')->insert([
                'judul_post' => $z. ' '. $faker->firstName,
                'jenis_hewan' => $z,
                'deskripsi' => $faker->text,
                'harga'     => rand(10,20) * 100000,
                'status' => 1,
                'store_id_store' => $id_store,
                'thumbnail' => 'tester/'.$z.'/'.'ANIMALS-'.rand(0,146).'.jpg'
            ]);
        }

    }
}
