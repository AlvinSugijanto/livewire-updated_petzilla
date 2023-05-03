<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCitiesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing cities data from API to local files';

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
        $kecamatanPath = public_path('daerah_indonesia/data_kabupaten.json');
        $kecamatans = json_decode(file_get_contents($kecamatanPath), true);

        $kecamatanData = [];
        // Loop through each province and retrieve its cities
        $i = 0;
        foreach ($kecamatans as $kecamatan) {

            foreach($kecamatan as $data){

                $id_kabupaten = $data['id'];
                $url = 'https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' . $data['id'];
                $citiesResponse = file_get_contents($url);
                $cities = json_decode($citiesResponse, true);
                $city = array_shift($cities);
                $kecamatanData[$id_kabupaten] = $city;
            }
        }
        
        // Write the $citiesData array to a file
        $file = public_path('daerah_indonesia/data_kecamatan.json');
        file_put_contents($file, json_encode($kecamatanData));
    }
}
