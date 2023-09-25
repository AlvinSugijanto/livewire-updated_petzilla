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
    private $dog, $cat, $deskripsi, $umur, $satuan_umur;

    public function __construct()
    {
        $this->dog = new Dog();
        $this->cat = new Cat();

        $this->deskripsi = [
            'Anak anjing Labrador yang muda dan bermain dengan aktif.',
            'Kucing tabby berwarna jingga yang penuh kasih sayang dan ramah.',
            'Anak anjing Pomeranian putih yang menggemaskan dan berbulu lebat.',
            'Anjing Australian Shepherd yang energik dan aktif.',
            'Kucing Persia berwarna abu-abu yang tenang dan penyayang.',
            'Anak anjing Border Collie yang pintar dan mudah dilatih.',
            'Anjing Golden Retriever yang setia dan ramah.',
            'Kucing Siamese yang bermain-main dan nakal.',
            'Anak anjing Chihuahua yang kecil dan menggemaskan.',
            'Kucing Ragdoll yang penyayang dan lembut.',
            'Anjing German Shepherd yang berani dan protektif.',
            'Kucing Russian Blue yang anggun dan elegan.',
            'Anak anjing Beagle yang ceria dan ramah.',
            'Kucing Bengal yang mandiri dan penuh rasa ingin tahu.',
            'Anjing Labrador Retriever yang setia dan patuh.',
            'Kucing Maine Coon yang ramah dan suka berbicara.',
            'Anak anjing Samoyed yang berbulu tebal dan bermain-main.',
            'Kucing British Shorthair yang tenang dan penyayang.',
            'Anjing Dalmatian yang aktif dan atletik.',
            'Kucing Ragamuffin yang lembut dan manis.',
            'Anak anjing Shetland Sheepdog yang cerdas dan setia.',
            'Kucing Abyssinian yang ceria dan penuh percaya diri.',
            'Anjing Cocker Spaniel yang ramah dan ceria.',
            'Kucing Sphynx yang anggun dan megah.',
            'Anak anjing French Bulldog yang manis dan bersemangat.',
            'Kucing Scottish Fold yang penyayang dan sosial.',
            'Anjing Jack Russell Terrier yang aktif dan bermain-main.',
            'Kucing Siamese yang anggun dan berwibawa.',
            'Anak anjing Toy Poodle yang menggemaskan dan mungil.',
            'Kucing Persian yang tenang dan penyayang.',
            'Anjing Rottweiler yang protektif dan penuh keberanian.',
            'Kucing Exotic Shorthair yang menggemaskan dan ramah.',
            'Anak anjing Australian Cattle Dog yang lincah dan aktif.',
            'Kucing Bengal yang bermain-main dan penuh energi.',
            'Anjing Boxer yang kuat dan setia.',
            'Kucing Scottish Fold yang misterius dan angkuh.',
            'Anak anjing Border Collie yang cerdas dan waspada.',
            'Kucing Tonkinese yang ramah dan suka bersosialisasi.',
            'Anjing Bulldog yang berani dan kuat.',
            'Kucing Himalaya yang manis dan penuh kasih sayang.',
            'Anjing Labrador Retriever yang antusias dan ramah.',
            'Kucing Ragdoll yang penyayang dan santai.',
            'Anak anjing Greyhound yang cepat dan penuh energi.',
            'Kucing Bengal yang penuh rasa ingin tahu dan suka berbicara.',
            'Anjing Shetland Sheepdog yang cerdas dan waspada.',
            'Kucing Balinese yang anggun dan mempesona.',
            'Anak anjing Boston Terrier yang kecil dan bersemangat.',
            'Kucing Abyssinian yang bermain-main dan aktif.',
            'Anjing Pomeranian yang penyayang dan mudah diajak berinteraksi.',
            'Kucing Bengal yang ramah dan suka bermain.',
        ];

        $this->umur = ['bayi', 'remaja', 'dewasa'];
        
    }
    public function run($id_animal, $id_store)
    {
        $faker = Faker::create('id_ID');
        $array = ['kucing', 'anjing'];
        $rand = rand(0,1);
        $z = $array[$rand];
        $random_status = array(
            'aktif',
            'dalam_persetujuan'
        );
        if($z == 'anjing')
        {
            $animal = $this->dog->getDog();
        }else{
            $animal = $this->cat->getCat();

        }
        $random_umur = rand(0,2);

        $random_deskripsi = rand(0,49);

        DB::table('list_animal')->insert([
            'id_animal' => $id_animal,
            'judul_post' => $animal['random_nama'],
            'jenis_hewan' => ucfirst($z),
            'deskripsi' => $this->deskripsi[$random_deskripsi],
            'harga'     => rand(10, 20) * 100000,
            'status' => $random_status[rand(0,1)],
            'stok'   => rand(1, 10),
            'store_id_store' => $id_store,
            'thumbnail' => $animal['image'][0],
            'surat_keterangan_sehat' => '/surat_keterangan_sehat.jpg',
            'created_at' => Carbon::now()->addMinute(rand(1,60)),
            'umur'       => $this->umur[$random_umur],
        ]);

        for ($i = 1; $i < count($animal['image']); $i++) {

            DB::table('animal_photo')->insert([
                'photo'           => $animal['image'][$i],
                'list_animal_id_animal' => $id_animal
            ]);
        }
    }


}
