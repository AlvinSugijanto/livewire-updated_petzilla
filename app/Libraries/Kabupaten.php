<?php
namespace App\Libraries;

class Kabupaten
{
    private $jsonData;

    public function __construct()
    {
        $file = public_path('daerah_indonesia/data_kabupaten.json');
        $this->jsonData = json_decode(file_get_contents($file), true);
    }

    public function getKabupatenFromProvinsi($id)
    {
        return $this->jsonData[$id];
    }
    public function getNama($id_provinsi, $id_kabupaten)
    {
        foreach($this->jsonData[$id_provinsi] as $kabupaten)
        {
            if($kabupaten['id'] == $id_kabupaten){
                return $kabupaten['nama'];
                break;
            }
        }
    }
}
