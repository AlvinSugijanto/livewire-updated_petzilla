<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Libraries\Races\Dog;
use Carbon\Carbon;

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
    public function randomAnimal($store)
    {
        return DB::table('list_animal')
            ->where('store_id_store', $store->id_store)
            ->inRandomOrder()
            ->first();
    }
    public function run()
    {

        $status = array(
            'pengajuan_ongkir',
            'menunggu_pembayaran',
            'review_pembayaran',
            'sedang_diproses',
            'sedang_dikirim',
            'sampai_tujuan',
            'selesai',
            'dalam_masalah'
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
        $review = array(
            "Saya sangat puas dengan toko ini! Saya membeli anjing Golden Retriever dan mereka memberikan layanan yang sangat baik.",
            "Toko ini memiliki pilihan anjing yang luar biasa. Saya menemukan teman sejati dalam anjing yang saya beli dari sini.",
            "Pelayanan pelanggan di toko ini sangat ramah dan membantu. Mereka menjawab semua pertanyaan saya dengan sabar.",
            "Saya senang dengan kualitas hewan yang dijual di toko ini. Anjing yang saya beli sehat dan aktif.",
            "Toko ini memiliki kucing-kucing yang sangat menggemaskan. Saya tidak bisa memilih hanya satu, jadi saya membeli dua!",
            "Pengiriman cepat dan aman. Anjing yang saya pesan tiba dalam kondisi yang baik dan sudah divaksin.",
            "Hewan peliharaan yang dijual di toko ini terawat dengan baik. Saya merasa yakin membeli hewan dari sini.",
            "Toko ini memberikan perhatian khusus pada kesejahteraan hewan. Mereka menjelaskan riwayat kesehatan dan memberikan saran perawatan yang baik.",
            "Pilihan ras anjing yang lengkap. Saya menemukan ras yang saya idamkan di toko ini.",
            "Saya sangat senang dengan pembelian saya. Kucing yang saya beli sangat manis dan cocok dengan keluarga saya.",
            "Proses pembelian yang mudah dan transparan. Saya dapat melihat informasi lengkap tentang hewan sebelum membelinya.",
            "Toko ini memberikan garansi kesehatan untuk hewan peliharaan yang dijual. Itu memberikan ketenangan pikiran yang besar.",
            "Staf di toko ini sangat berpengetahuan tentang hewan peliharaan dan memberikan saran yang sangat berguna.",
            "Toko ini sangat peduli dengan adopsi hewan. Saya mendapatkan kucing yang membutuhkan rumah baru dan memberinya kasih sayang yang dia butuhkan.",
            "Hewan peliharaan yang saya beli dari toko ini sudah dilatih dengan baik. Mereka sudah terbiasa dengan lingkungan rumah.",
            "Toko ini memiliki pilihan aksesoris dan makanan yang lengkap untuk hewan peliharaan. Saya tidak perlu mencari ke tempat lain.",
            "Saya sangat terkesan dengan kebersihan dan keamanan di toko ini. Hewan peliharaan dipelihara dengan baik.",
            "Pengalaman belanja yang menyenangkan. Saya merasa nyaman dan dipandu dengan baik oleh staf toko.",
            "Saya mendapatkan anjing yang sehat dan memiliki riwayat vaksinasi yang lengkap. Dokumen kesehatannya disediakan dengan baik.",
            "Toko ini memiliki program adopsi yang luar biasa. Saya merasa bangga telah memberikan rumah bagi kucing yang membutuhkan.",
            "Saya mendapatkan kucing dengan harga yang wajar dan rasanya seperti mendapatkan kesepakatan yang bagus.",
            "Staf toko sangat ramah terhadap hewan peliharaan. Mereka memperlakukan mereka dengan penuh perhatian dan kasih sayang.",
            "Saya senang dengan layanan pengiriman yang disediakan oleh toko ini. Anjing yang saya beli tiba dengan selamat di rumah.",
            "Toko ini memberikan panduan perawatan setelah pembelian. Itu sangat membantu bagi pemilik hewan yang baru.",
            "Saya sangat terkesan dengan profesionalisme staf toko. Mereka menjawab semua pertanyaan saya dengan jelas dan akurat.",
            "Saya merekomendasikan toko ini kepada siapa pun yang ingin membeli hewan peliharaan. Mereka adalah tempat yang tepercaya dan dapat diandalkan.",
            "Hewan peliharaan yang saya beli sudah divaksin dengan baik. Saya merasa tenang karena mereka telah menjalani perawatan medis yang tepat.",
            "Toko ini memiliki pilihan ras anjing yang lengkap. Saya menemukan anjing yang sempurna sesuai dengan preferensi saya.",
            "Staf toko sangat membantu dalam memandu saya memilih hewan peliharaan yang cocok dengan gaya hidup saya.",
            "Saya sangat senang dengan kualitas pelayanan yang diberikan oleh toko ini. Mereka sangat peduli dengan kebutuhan hewan peliharaan.",
            "Toko ini memberikan harga yang kompetitif dan saya mendapatkan nilai yang luar biasa untuk pembelian saya.",
            "Saya merasa aman berbelanja di toko ini karena mereka memberikan jaminan kesehatan dan keaslian hewan peliharaan.",
        );
        for ($i = 0; $i < 2000; $i++) {

            $user = $this->randomUser();
            $store = $this->randomStore();
            $animal = $this->randomAnimal($store);

            $random_qty = rand(1, 5);
            $random_status = rand(0, 7);
            $random_ongkir = rand(1, 10) * 10000;
            $id_transaction = strtoupper('TRX-' . Str::random(10, 'alnum'));


            if ($random_status != 0) {
                DB::table('transaction')->insert([
                    'id_transaction' => $id_transaction,
                    'qty' => $random_qty,
                    'sub_total' => $random_qty * $animal->harga,
                    'grand_total' => ($random_qty * $animal->harga) + $random_ongkir,
                    'status'      => $status[$random_status],
                    'users_id_user' => $user->id_user,
                    'store_id_store' => $store->id_store,
                    'list_animal_id_animal' => $animal->id_animal,
                    'created_at'     => Carbon::now(),
                    'completed_at' => $random_status == 6 ? Carbon::now()->addDay() : null,
                ]);
                DB::table('informasi_pengiriman')->insert([
                    'jasa_pengiriman' => $nama_pengiriman[rand(1, 7)],
                    'biaya_pengiriman' => $random_ongkir,
                    'transaction_id_transaction' => $id_transaction
                ]);

            }else
            {
                DB::table('transaction')->insert([
                    'id_transaction' => $id_transaction,
                    'qty' => $random_qty,
                    'sub_total' => $random_qty * $animal->harga,
                    'status'      => $status[$random_status],
                    'users_id_user' => $user->id_user,
                    'store_id_store' => $store->id_store,
                    'list_animal_id_animal' => $animal->id_animal,
                    'created_at'     => Carbon::now(),
                    'completed_at' => $random_status == 6 ? Carbon::now()->addDay() : null,
                ]);
            }
            if ($random_status == 6) {

                $should_review = rand(0, 1);
                if ($should_review == 1) {
                    $random_review = rand(0, 29);

                    DB::table('rating_and_review')->insert([
                        'rating'  => rand(3, 5),
                        'review'  => $review[$random_review],
                        'transaction_id_transaction' => $id_transaction,
                        'created_at'    => Carbon::now()
                    ]);
                }
            }
            if ($random_status > 1) {
                $faker = Faker::create('id_ID');
                $tipe_pembayaran = array('transfer_bank', 'digital_payment');
                $random_tipe_pembayaran = array_rand($tipe_pembayaran, 1);
                if ($random_tipe_pembayaran == 0) {
                    $pembayaran = array('bca', 'bni', 'bri', 'mandiri');
                    $random_pembayaran = array_rand($pembayaran, 1);
                }else{
                    $pembayaran = array('ovo', 'gopay', 'shopeepay', 'dana');
                    $random_pembayaran = array_rand($pembayaran, 1);

                }

                DB::table('bukti_pembayaran')->insert([
                    'tipe_rekening'   => $tipe_pembayaran[$random_tipe_pembayaran],
                    'jenis_rekening'  => strtoupper($pembayaran[$random_pembayaran]),
                    'nama_rekening'  => $faker->name,
                    'nomor_rekening' => mt_rand(10000000, 99999999),
                    'bukti_pembayaran'    => '/animal_photos/bukti_pembayaran.jpg',
                    'transaction_id_transaction' => $id_transaction,
                    'created_at' => Carbon::now()->subMinute(rand(1, 60)),
                ]);
            }
            if($random_status == 6)
            {
               
                $complain = DB::table('complain')->insertGetId([
                    'komentar' => 'produk saya dalam masalah',
                    'status' => 'dalam_review',
                    'created_at' => Carbon::now()->addMinute(rand(1, 60)),
                    'transaction_id_transaction' => $id_transaction
                ]);
                
                $assign = DB::table('complain')->where('id', $complain)->first();
                
                for ($i = 1; $i < 3; $i++) {
                    DB::table('complain_photo')->insert([
                        'photo' => '/buktifoto' . $i . '.jpg',
                        'complain_id' => $assign->id
                    ]);
                }
            }
        }
    }
}
