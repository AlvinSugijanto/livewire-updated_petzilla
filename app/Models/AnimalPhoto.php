<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnimalPhoto extends Model
{
    protected $table = 'animal_photo';

    public $timestamps = false;
    protected $primaryKey = 'id_animal_photo';

    protected $fillable = [
        'id_animal_photo',
        'photo',
        'list_animal_id_animal'
    ];

    public function storePhoto($photos, $id)
    {
        if(!empty($photos)){

            foreach($photos as $photoz){
                $photo = Storage::disk('public')->put($id, $photoz);
                $this->create([
                    'photo' => $photo,
                    'list_animal_id_animal' => $id
                ]);
            };
        }

    }
    public function editPhoto($photos, $id)
    {
        foreach($photos as $photoz){
            $photo = Storage::disk('public')->put($id, $photoz);
            $this->create([
                'photo' => $photo,
                'list_animal_id_animal' => $id
            ]);
        };

    }
}
