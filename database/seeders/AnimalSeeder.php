<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AnimalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $array = ['Kucing','Anjing'];
        $rand = array_rand($array);
        $z = $array[$rand];

        for($i=0;$i<5;$i++){

            DB::table('list_animal')->insert([
                'id_animal' => $i+1,
                'judul_post' => $z. ' '. $faker->firstName,
                'jenis_hewan' => $z,
                'deskripsi' => $faker->text,
                'harga'     => rand(1000000, 2000000),
                'status' => 1,
                'store_id_store' => 'pGpa2e5DUc'
            ]);
        }    
    }
}
