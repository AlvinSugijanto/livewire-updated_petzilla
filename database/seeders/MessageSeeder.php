<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MessageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat')->insert([
            'message' => 'Aselole',
            'from_id_user' => '1QquH5Wgxf',
            'to_id_user'   => '99a11W1Zuh',

        ]);    
    }
}
