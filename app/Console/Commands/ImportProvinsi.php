<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportProvinsi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data-provinsi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $provincesResponse = file_get_contents('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinces = json_decode($provincesResponse, true);
        $province = array_shift($provinces);


        $file = public_path('daerah_indonesia/data_provinsi.json');
        file_put_contents($file, json_encode($province));
    }
}
