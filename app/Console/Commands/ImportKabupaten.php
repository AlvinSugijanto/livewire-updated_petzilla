<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportKabupaten extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:kabupaten-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing Kabupaten data from API to local files';

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
        $provincesPath = public_path('daerah_indonesia/data_provinsi.json');
        $provinces = json_decode(file_get_contents($provincesPath), true);
        // Create an empty array to hold all cities data
        $citiesData = [];
        

        // $file = public_path('daerah_indonesia/data_kabupaten.json');
        // $kabupatens = json_decode(file_get_contents($file), true);

        // dd($kabupatens[94]);
        // Loop through each province and retrieve its cities
        foreach ($provinces as $provinceData) {
            $provinceId = $provinceData['id'];
            $url = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . $provinceId;
            $citiesResponse = file_get_contents($url);
            $cities = json_decode($citiesResponse, true);
            $city = array_shift($cities);
            $citiesData[$provinceId] = $city;

        }
        
        $file = public_path('daerah_indonesia/data_kabupaten.json');
        file_put_contents($file, json_encode($citiesData));
    }
}
