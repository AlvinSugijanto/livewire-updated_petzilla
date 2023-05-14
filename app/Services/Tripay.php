<?php

namespace App\Services;


class Tripay
{

    private $apiKey, $privateKey, $merchantCode;

    public function __construct()
    {
        $this->apiKey = 'DEV-vMePgEO80YfJyqvxe2LLjTdjkmE6PbsljS6JLe0u';
        $this->privateKey   = 'LDMJ1-lMKgH-OzbCC-Vljdy-hQA3q';
        $this->merchantCode = 'T22018';
    }
    public function get_payment_channels()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);


        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }
    public function request_transaction($product)
    {
        $merchantRef = 'TX-' . time();

        $amount       = $product->animal->harga;

        $data = [
            'method'         => 'BCAVA',
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $product->user->name,
            'customer_email' => $product->user->email,
            'customer_phone' => $product->user->phone_number,
            'order_items'    => [
                [
                    'sku'         => $product->animal->id_animal,
                    'name'        => $product->animal->judul_post,
                    'price'       => $product->animal->harga,
                    'quantity'    => 1,
                ]
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $this->merchantCode . $merchantRef . $amount, $this->privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }

    public function detail_transaction($reference)
    {

        $payload = ['reference'    => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $this->apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }
}
