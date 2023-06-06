<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreModel;
use App\Libraries\Kecamatan;
use App\Models\Transaction;

class ListAnimal extends Model
{
    protected $table = 'list_animal';

    protected $primaryKey = 'id_animal';

    public $incrementing = false;

    protected $fillable = [
        'id_animal',
        'jenis_hewan',
        'judul_post',
        'deskripsi',
        'harga',
        'surat_keterangan_sehat',
        'sertifikat_pedigree',
        'thumbnail',
        'status',
        'stok',
        'warna',
        'umur',
        'satuan_umur',
        'store_id_store'
    ];
    public function store()
    {
        return $this->belongsTo(StoreModel::class, 'store_id_store', 'id_store'); 
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'list_animal_id_animal', 'id_animal');
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'list_animal_id_animal', 'id_animal');
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
