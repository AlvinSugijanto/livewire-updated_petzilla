<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Libraries\Races\Dog;
use App\Libraries\Races\Cat;
use Carbon\Carbon;


class NewAnimalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    private $dog, $cat;

    public function __construct()
    {
        $this->dog = new Dog();
        $this->cat = new Cat();

    }
    public function run($id_animal, $id_store)
    {
        $faker = Faker::create('id_ID');
        $array = ['kucing', 'anjing'];
        $rand = rand(0,1);
        $z = $array[$rand];

        if($z == 'anjing')
        {
            $animal = $this->dog->getDog();
        }else{
            $animal = $this->cat->getCat();

        }

        DB::table('list_animal')->insert([
            'id_animal' => $id_animal,
            'judul_post' => $animal['random_nama'],
            'jenis_hewan' => ucfirst($z),
            'deskripsi' => $faker->text,
            'harga'     => rand(10, 20) * 100000,
            'status' => 'aktif',
            'stok'   => rand(1, 10),
            'store_id_store' => $id_store,
            'thumbnail' => $animal['image'][0],
            'created_at' => Carbon::now()->addMinute(rand(1,60))
        ]);

        for ($i = 1; $i < count($animal['image']); $i++) {

            DB::table('animal_photo')->insert([
                'photo'           => $animal['image'][$i],
                'list_animal_id_animal' => $id_animal
            ]);
        }
    }


}
