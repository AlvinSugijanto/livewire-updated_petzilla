<?php

namespace App\Libraries\Races;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Cat{

    private $ras_hewan, $random_year, $random_warna;

    public function __construct()
    {
        $this->ras_hewan = [
            'Bengal',
            'Exotic Shorthair',
            'Himalayan',
            'Maine Coon',
            'Munchkin',
            'Norwegian Forest Cat',
            'Persian',
            'Ragdoll',
            'Scottish Fold',
            'Siamese',
            'Siberian',
            'Snowshoe',
            'Somali',
            'Sphynx',
            'Tonkinese',
            'Toyger',
            'Turkish Van'
        ];

        $this->random_warna = [
            'Putih',
            'Hitam',
            'Abu-abu',
            'Black and White',
            'Black',
            'White',
            'Coklat',

        ];
        // dd($this->ras_hewan['message']['african']);
    }

    public function getCat()
    {
        $randomKey = array_rand($this->ras_hewan);
        $randomBreed = $this->ras_hewan[$randomKey];

        $rand = rand(3,5);
        for($i=0; $i<$rand; $i++)
        {
            $random_lagi = rand(0,19);
            $image_path[$i] = 'kucing/'.$randomBreed.'/'.$randomBreed.$random_lagi.'.jpg';

        }

        $random_nama = ucwords('Kucing '. $randomBreed. ' '. $this->random_warna[rand(0,6)].' ' .rand(1,5).' tahun');
        

        return [
            'jenis_ras' => $randomBreed,
            'image'     => $image_path,
            'random_nama' =>$random_nama
        ];

    }
}