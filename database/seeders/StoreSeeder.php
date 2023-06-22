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
        $this->nama_toko = array(
            "Paws and Tails",
            "The Furry Boutique",
            "Whiskers & Woofs",
            "Happy Paws Pet Shop",
            "Feline and Canine Haven",
            "The Wagging Tail",
            "Purrfect Pets",
            "Doggy Delights",
            "Kitty Couture",
            "Pawsome Pet Emporium",
            "The Cat's Meow",
            "Barking Buddies",
            "Kitten Caboodle",
            "The Paw Palace",
            "Puppy Love Pet Store",
            "Meow Market",
            "The Dog House",
            "Kitty Kingdom",
            "Tail Waggers",
            "The Whisker Shop",
            "Pampered Paws",
            "Pawesome Pets",
            "The Canine Corner",
            "Fuzzy Friends",
            "Kitty Cuddles",
            "The Pooch Parlor",
            "Cats and Canines",
            "Pawsitively Purrfect",
            "The Woof Den",
            "Purrs and Wags",
            "The Furry Farm",
            "The Barkery",
            "Whisker Wonders",
            "Paws & Claws",
            "Feline Fancy",
            "Doggy Depot",
            "The Kitty Haven",
            "Puppy Pals",
            "Meow Mania",
            "The Wagging Whisker",
            "Kitty Komfort",
            "The Pawsome Place",
            "Furry Fun",
            "Pawsome Puppies",
            "The Cuddle Cove",
            "The Purrfect Spot",
            "Barking Boutique",
            "Kitten Kisses",
            "The Woof Warehouse",
            "Pampered Pets",
            "Meow Madness",
            "The Tail Trail",
            "Puppy Playland",
            "The Kitty Corner",
            "Whisker Wonderland",
            "Paws R Us",
            "Feline Fantasy",
            "Doggy Delights",
            "The Pawsome Pawtique",
            "Kitty Catwalk",
            "The Bark and Meow",
            "Purrfection Pets",
            "The Woof and Whisker",
            "Paws Galore",
            "Furry Friends Forever",
            "Kitty Kastle",
            "The Tail Wag",
            "Puppy Paradise",
            "The Meow Mart",
            "The Wagging Whisker",
            "Kitty Kompany",
            "The Pawsome Pet Store",
            "Puppy Pals",
            "Meow Mania",
            "The Wagging Warehouse",
            "Pampered Paws",
            "Furry Felines",
            "The Cat's Corner",
            "Paws of Love",
            "The Woof and Meow",
            "Purrfectly Puppies",
            "The Whisker Haven",
            "Doggy Delights",
            "Kitty Couture",
            "The Pawsome Emporium",
            "Puppy Love",
            "Meow Market",
            "The Bark Boutique",
            "Whisker Wonders",
            "Paws & Claws",
            "Feline Fancy",
            "Doggy Depot",
            "The Kitty Kingdom",
            "Puppy Pals",
            "Meow Mania",
            "The Wagging Whisker"
        );
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
    public function run($id_user, $id_store)
    {
        $faker = Faker::create('id_ID');
        $randomProv = rand(31,36);

        $geo_data = $this->geocode($randomProv);

        
        while(empty($geo_data['getLatLng'])){
            $geo_data = $this->geocode($randomProv);
        }

        $random_namaToko = array_rand($this->nama_toko,1);
        $store = DB::table('store')->insert([
            'id_store' => $id_store,
            'nama_toko' => $this->nama_toko[$random_namaToko],
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

        // for($i=0; $i<5; $i++)
        // {
        //     $array = ['Kucing','Anjing'];
        //     $rand = array_rand($array);
        //     $z = $array[$rand];

        //     DB::table('list_animal')->insert([
        //         'judul_post' => $z. ' '. $faker->firstName,
        //         'jenis_hewan' => $z,
        //         'deskripsi' => $faker->text,
        //         'harga'     => rand(10,20) * 100000,
        //         'status' => 'Aktif',
        //         'stok'   => rand(0,10),
        //         'store_id_store' => $id_store,
        //         'thumbnail' => 'tester/'.$z.'/'.'ANIMALS-'.rand(0,146).'.jpg'
        //     ]);
        // }

    }
}
