<?php
namespace App\Libraries;

class Provinsi
{
    public $jsonData;

    public function __construct()
    {
        $file = public_path('daerah_indonesia/data_provinsi.json');
        $this->jsonData = json_decode(file_get_contents($file), true);
    }

    public function all()
    {
        return $this->jsonData;
    }
    public function getNama($id_provinsi)
    {
        foreach($this->jsonData as $provinsi)
        {
            if($provinsi['id'] == $id_provinsi)
                return $provinsi['nama'];
        }
        
    }
}
