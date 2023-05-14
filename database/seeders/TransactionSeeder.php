<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function randomUser()
    {
        return DB::table('users')
            ->inRandomOrder()
            ->first();
    }
    public function randomStore()
    {
        return DB::table('store')
            ->inRandomOrder()
            ->first();
    }
    public function randomAnimal()
    {
        return DB::table('list_animal')
            ->inRandomOrder()
            ->first();
    }
    public function run()
    {
        $status = array(
            'pengajuan_ongkir',
            'menunggu_pembayaran',
            'sedang_diproses',
            'sedang_dikirim',
            'sampai_tujuan'
        );
        $nama_pengiriman = array(
            'JNE Express',
            'J&T',
            'POS INDONESIA',
            'TIKI',
            'SICEPAT',
            'Ninja Express',
            'Indah Logistik',
            'Wahana Express'
        );
        for ($i = 0; $i < rand(3, 10); $i++) {

            $user = $this->randomUser();
            $store = $this->randomStore();
            $animal = $this->randomAnimal();

            $random_total = rand(10, 20) * 100000;
            $random_status = rand(0, 4);
            $id_transaction = Str::random(10);

            DB::table('transaction')->insert([
                'id_transaction' => $id_transaction,
                'qty' => rand(1, 10),
                'sub_total' => $random_total,
                'grand_total' => $random_total + (rand(1, 10) * 10000),
                'status'      => $status[$random_status],
                'users_id_user' => $user->id_user,
                'store_id_store' => $store->id_store,
                'list_animal_id_animal' => $animal->id_animal
            ]);
            if ($random_status == 1) {
                DB::table('informasi_pengiriman')->insert([
                    'jasa_pengiriman' => $nama_pengiriman[rand(1, 7)],
                    'biaya_pengiriman' => rand(1, 10) * 10000,
                    'transaction_id_transaction' => $id_transaction
                ]);
            }
        }
    }
}
