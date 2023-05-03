<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Chat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_user';
    public $incrementing = false;


    protected $fillable = [
        'id_user',
        'name',
        'email',
        'password',
        'alamat_lengkap',
        'phone_number',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'latitude',
        'longitude',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function verifyUser(){
        return $this->hasOne('App\Models\VerifyUser', 'user_id_user', 'id_user');
    }
    public function messagesFrom()
    {
        return $this->hasMany(Chat::class, 'from_id_user','id_user');
    }
    public function messagesTo()
    {
        return $this->hasMany(Chat::class, 'to_id_user','id_user');
    } 
    public function geocode($data)
    {
        $nama_kecamatan = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/district/'.$data['kecamatan'].'.json')->json();
        $nama_kabupaten = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/regency/'.$data['kabupaten'].'.json')->json();

        $temp = explode(" ", $nama_kabupaten['name']);
        $kabupaten_name = implode(" ", array_slice($temp, 1));
        $getLatLng = Http::get('https://geocode.maps.co/search?q='.$nama_kecamatan['name'].', '.$kabupaten_name)->json();

        $data['id_user'] = Str::random(10);
        $data['password'] = bcrypt($data['password']);
        $data['latitude'] = $getLatLng[0]['lat'];
        $data['longitude'] = $getLatLng[0]['lon'];

        return $data;
    }
    public function getAddress($prov, $kab, $kec)
    {
        $provObject = new Provinsi();
        $kabObject = new Kabupaten();
        $kecObject = new Kecamatan();

        $nama_provinsi = $provObject->getNama($prov);
        $nama_kabupaten = $kabObject->getNama($prov,$kab);
        $nama_kecamatan = $kecObject->getNama($kab,$kec);


        return $nama_kecamatan.', '.$nama_kabupaten.', '.$nama_provinsi;
    }
}
