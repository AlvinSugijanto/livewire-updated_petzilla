<?php
namespace App\Libraries;

class Kecamatan
{
    public $jsonData;

    public function __construct()
    {
        $file = public_path('daerah_indonesia/data_kecamatan.json');
        $this->jsonData = json_decode(file_get_contents($file), true);
    }

    public function getKecamatanFromKabupaten($id)
    {
        return $this->jsonData[$id];
    }
    public function getNama($id_kabupaten, $id_kecamatan)
    {
        foreach($this->jsonData[$id_kabupaten] as $kecamatan)
        {
            if($kecamatan['id'] == $id_kecamatan){
                return $kecamatan['nama'];
                break;
            }
        }
    }
}
