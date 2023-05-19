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
    public function run($id_animal, $id_store)
    {
        $faker = Faker::create('id_ID');
        $array = ['kucing', 'anjing'];
        $rand = array_rand($array);
        $z = $array[$rand];


        DB::table('list_animal')->insert([
            'id_animal' => $id_animal,
            'judul_post' => $z . ' ' . $faker->firstName,
            'jenis_hewan' => $z,
            'deskripsi' => $faker->text,
            'harga'     => rand(10, 20) * 100000,
            'status' => 'aktif',
            'stok'   => rand(0, 10),
            'store_id_store' => $id_store,
            'thumbnail' => 'tester/' . $z . '/' . 'ANIMALS (' . rand(0, 199) .')' . '.jpg'
        ]);

        for ($i = 0; $i < rand(1, 5); $i++) {

            DB::table('animal_photo')->insert([
                'photo'           => 'tester/' . $z . '/' . 'ANIMALS (' . rand(0, 199) .')' . '.jpg',
                'list_animal_id_animal' => $id_animal
            ]);
        }
    }
}
