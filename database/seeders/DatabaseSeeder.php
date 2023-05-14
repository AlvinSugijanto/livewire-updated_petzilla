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
    public $user_seeder, $store_seeder, $animal_seeder, $transaction_seeder;
    public $counter = 0;

    public function __construct()
    {
        $this->user_seeder = new UserSeeder();
        $this->store_seeder = new StoreSeeder();
        $this->animal_seeder = new AnimalSeeder();
        $this->transaction_seeder = new TransactionSeeder();
    }
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {

            $id_user = Str::random(10);
            $id_store = Str::random(10);
            $id_animal = Str::random(10);

            $this->user_seeder->run($id_user);
            $this->store_seeder->run($id_user, $id_store);
            $this->animal_seeder->run($id_animal, $id_store);

            for ($i = 0; $i < rand(1, 10); $i++) {
                $loop_id_animal = Str::random(10);
                // $loop_id_transaction = Str::random(10);

                $this->animal_seeder->run($loop_id_animal, $id_store);
                // $this->transaction_seeder->run($id_user, $id_store, $id_animal, $loop_id_transaction);
            }
            $this->transaction_seeder->run();


            var_dump('=== ' . $this->counter++ . ' ===');
        }

    }
}