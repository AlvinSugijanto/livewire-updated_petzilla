<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ListAnimal;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Http;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

class StoreModel extends Model
{
    protected $table = 'store';

    public $timestamps = false;

    protected $primaryKey = 'id_store';
    public $incrementing = false;

    protected $fillable = [
        'id_store',
        'nama_toko',
        'description',
        'alamat_lengkap',
        'no_hp',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'user_id_user',
        'latitude',
        'longitude'
    ];
    public function messages()
    {
        return $this->hasMany(Chat::class, 'store_id_store', 'id_store');
    }
    public function latest_message()
    {
        return $this->hasOne(Chat::class, 'store_id_store', 'id_store')->latest()
            ->where('sender_type', 'store')
            ->latest();
    }
    public function listAnimal()
    {
        return $this->hasMany(ListAnimal::class, 'store_id_store', 'id_store');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_user', 'id_user');
    }
    public function getAddress($prov, $kab, $kec)
    {
        $provObject = new Provinsi();
        $kabObject = new Kabupaten();
        $kecObject = new Kecamatan();

        $nama_provinsi = $provObject->getNama($prov);
        $nama_kabupaten = $kabObject->getNama($prov, $kab);
        $nama_kecamatan = $kecObject->getNama($kab, $kec);

        return $nama_kecamatan . ', ' . $nama_kabupaten . ', ' . $nama_provinsi;
    }
    public function getProvinsi($prov)
    {
        $object = new Provinsi();
        $nama_provinsi = $object->getNama($prov);

        return $nama_provinsi;
    }
    public function getKabupaten($prov, $kab)
    {
        $object = new Kabupaten();
        $nama_kabupaten = $object->getNama($prov, $kab);

        return $nama_kabupaten;
    }
    public function getKecamatan($kab, $kec)
    {
        $object = new Kecamatan();
        $nama_kecamatan = $object->getNama($kab, $kec);

        return $nama_kecamatan;
    }

    public function geocode($data)
    {
        $kabObject = new Kabupaten();
        $kecObject = new Kecamatan();

        $nama_kecamatan = $kecObject->getNama($data['kabupaten'], $data['kecamatan']);
        $nama_kabupaten = $kabObject->getNama($data['provinsi'], $data['kabupaten']);

        $temp = explode(" ", $nama_kabupaten);
        $kabupaten_name = implode(" ", array_slice($temp, 1));
        $getLatLng = Http::get('https://geocode.maps.co/search?q=' . $nama_kecamatan . ', ' . $kabupaten_name)->json();

        $data['latitude'] = $getLatLng[0]['lat'];
        $data['longitude'] = $getLatLng[0]['lon'];

        return $data;
    }
}
