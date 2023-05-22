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

class UserSeeder extends Seeder
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
    public function run($id)
    {
        $faker = Faker::create('id_ID');
        $randomProv = rand(31,36);

        $geo_data = $this->geocode($randomProv);

        while(empty($geo_data['getLatLng'])){
            $geo_data = $this->geocode($randomProv);
        }
        // if(empty($geo_data['getLatLng'])){
        //     dd($geo_data);
        // }
        DB::table('users')->insert([
            'id_user' => $id,
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('alvin5210'),
            'name' => $faker->name,
            'alamat_lengkap' => $faker->address,
            'phone_number'  => $faker->phoneNumber,
            'provinsi'  =>$randomProv,
            'kabupaten' =>$geo_data['randomKab']['id'],
            'kecamatan' => $geo_data['randomKec']['id'],
            'latitude'    => $geo_data['getLatLng'][0]['lat'],
            'longitude'     => $geo_data['getLatLng'][0]['lon'],
            'created_at'    => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ]);    
    }
}
