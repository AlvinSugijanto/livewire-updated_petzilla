<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user_seeder = new UserSeeder();
        $this->store_seeder = new StoreSeeder();
    }
    public function run()
    {
        for($i=0;$i<100;$i++)
        {
            $id = Str::random(10);
            $this->user_seeder->run($id);
            $this->store_seeder->run($id, $i);
            var_dump('=== '. $i+1 . ' ===');
        }
        // $this->call([
        //     UserSeeder::class,
        //     PostSeeder::class,
        //     CommentSeeder::class,
        // ]);
    }
}
