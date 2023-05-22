<?php

namespace App\Console\Commands\Cats;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportCatData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cat-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing cat data from API to local files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $testing = $this->testing();
        // $catlist = $this->getImage($testing);

        foreach ($testing as $tes) {
            $this->getImage($tes);
        }
        // for ($i = 0; $i < count($catlist); $i++) {

        //     $fileContents = file_get_contents($catlist[$i]->url);

        //     $fileName = 'hima' . $i . '.jpg'; // Provide a desired file name

        //     Storage::disk('public')->put('kucing/hima/' . $fileName, $fileContents);
        // }
    }


    public function getImage($breed)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.thecatapi.com/v1/images/search?format=json&limit=50&breed_ids=' . $breed['id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: live_qxLGi0466VwKZ1ih7CyfQZbxW0ZUA5OBTvdTCKcf6mhZShothzGSDplfmGGmdi9H'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        if(count($response) > 20)
        {
            for ($i = 0; $i < 20; $i++) {

                $fileContents = file_get_contents($response[$i]->url);
    
                $fileName = $breed['breed']. $i . '.jpg'; // Provide a desired file name
    
                Storage::disk('public')->put('kucing/'.$breed['breed'].'/' . $fileName, $fileContents);
            }
        }

    }

    public function testing()
    {
        $curl = curl_init();

        // get list of cat breeds
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.thecatapi.com/v1/breeds',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-api-key: live_qxLGi0466VwKZ1ih7CyfQZbxW0ZUA5OBTvdTCKcf6mhZShothzGSDplfmGGmdi9H'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $breed =  json_decode($response);

        for ($i = 0; $i < count($breed); $i++) {

            $data[$i]['id'] = $breed[$i]->id;
            $data[$i]['breed'] = $breed[$i]->name;
        }

        return $data;
    }
    // public function getCat()
    // {
    //     $curl = curl_init();

    //     // get list of cat breeds
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.thecatapi.com/v1/breeds?limit=10&page=0',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json',
    //             'x-api-key: live_qxLGi0466VwKZ1ih7CyfQZbxW0ZUA5OBTvdTCKcf6mhZShothzGSDplfmGGmdi9H'
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     $breedList = json_decode($response);

    //     // dd($breedList[0]->name);
    //     for($i=0; $i<count($breedList); $i++)
    //     {

    //         $data[$i]['id'] = $breedList[$i]->id;
    //         $data[$i]['breed'] = $breedList[$i]->name;

    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => 'https://api.thecatapi.com/v1/images/search?format=json&limit=10&breed_ids='.$breedList[$i]->id,
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => 'GET',
    //             CURLOPT_HTTPHEADER => array(
    //               'Content-Type: application/json',
    //               'x-api-key: live_qxLGi0466VwKZ1ih7CyfQZbxW0ZUA5OBTvdTCKcf6mhZShothzGSDplfmGGmdi9H'
    //             ),
    //           ));
    //         $response = curl_exec($curl);

    //         curl_close($curl);

    //         $response = json_decode($response);

    //         for($y=0; $y<count($response); $y++)
    //         {
    //             $data[$i]['image'][$y] = $response

    //         }
    //         dd($response[9]->url);

    //     }


    // }
}
