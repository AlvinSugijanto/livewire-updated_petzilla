<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('admin')->insert([
            'id' => strtoupper('ADMIN-'.Str::random(10,'alnum')),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('alvin5210'),
        ]);

    }


}
