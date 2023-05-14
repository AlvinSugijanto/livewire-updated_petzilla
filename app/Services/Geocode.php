<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

class Geocode{


    public function __construct()
    {
        $this->kabObject = new Kabupaten();
        $this->kecObject = new Kecamatan();
    }

    public function handle($data)
    {
        $nama_kecamatan = $this->kecObject->getNama($data['kabupaten'], $data['kecamatan']);
        $nama_kabupaten = $this->kabObject->getNama($data['provinsi'], $data['kabupaten']);

        $temp = explode(" ", $nama_kabupaten);
        $kabupaten_name = implode(" ", array_slice($temp, 1));
        $getLatLng = Http::get('https://geocode.maps.co/search?q=' . $nama_kecamatan . ', ' . $kabupaten_name)->json();
        
        if(empty($getLatLng))
        {
            return false;
        }
        return $getLatLng[0];
    }

    public function geocode_from_coordinate($coordinate)
    {
        $data = explode(",", $coordinate);
       
        $array = array([
            'lat' => $data[0],
            'lon' => $data[1]
        ]);
        
        return $array[0];

    }

}