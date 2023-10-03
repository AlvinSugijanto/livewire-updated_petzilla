<?php

namespace App\Libraries;

class GetAllCityName
{
    public $provinsi, $kabupaten, $kecamatan;

    public function __construct()
    {
        $this->provinsi = json_decode(file_get_contents(public_path('daerah_indonesia/data_provinsi.json')), true);
        $this->kabupaten = json_decode(file_get_contents(public_path('daerah_indonesia/data_kabupaten.json')), true);
        $this->kecamatan = json_decode(file_get_contents(public_path('daerah_indonesia/data_kecamatan.json')), true);
    }

    public function getName()
    {
        $i = 0;
        foreach ($this->kecamatan as $kabupaten) {
            foreach ($kabupaten as $kecamatan) {
                $kabupatenName = $this->getKabupatenNameFromKecamatan($kecamatan['id_kota']);
                $kecamatanNameArray[$i] = $kecamatan['nama'] . ', '.$kabupatenName;

                $i++;
            }
        }
        return $kecamatanNameArray;
    }

    public function getKabupatenNameFromKecamatan($id_kabupaten)
    {
        foreach ($this->kabupaten as $provinsi) {
            foreach ($provinsi as $kabupaten) {
                if($kabupaten['id'] == $id_kabupaten)
                {
                    foreach($this->provinsi as $provinsi)
                    {
                       if($provinsi['id'] == $kabupaten['id_provinsi'])
                       {
                            return $kabupaten['nama'] .', '.$provinsi['nama'];
                       } 
                    }
                }
            }
        }
    }
}
