<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreModel;
use App\Libraries\Kecamatan;


class ListAnimal extends Model
{
    protected $table = 'list_animal';

    protected $primaryKey = 'id_animal';

    protected $fillable = [
        'jenis_hewan',
        'judul_post',
        'deskripsi',
        'harga',
        'surat_keterangan_sehat',
        'sertifikat_pedigree',
        'thumbnail',
        'status',
        'store_id_store'
    ];
    public function store()
    {
        $data = $this->belongsTo(StoreModel::class, 'store_id_store', 'id_store'); 
        return $data;
    }
    public function getStore($data)
    {
       
        $store_model = new StoreModel();

        $nama_kabupaten = $store_model->getKabupaten($data->provinsi, $data->kabupaten);
        $nama_kecamatan = $store_model->getKecamatan($data->kabupaten, $data->kecamatan);

        $data->kabupaten = $nama_kabupaten;
        $data->kecamatan = $nama_kecamatan;
        
        return $data;
    }
    public function getKecamatan($kab, $kec)
    {
        $object = new Kecamatan();
        $nama_kecamatan = $object->getNama($kab, $kec);

        return $nama_kecamatan;
    }
}
