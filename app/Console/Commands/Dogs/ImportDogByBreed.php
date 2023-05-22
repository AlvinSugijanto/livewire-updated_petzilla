<?php

namespace App\Console\Commands\Dogs;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportDogByBreed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dog-breed-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing dog data from API to local files';

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
        // $dog_list = [
        //     'samoyed',
        //     'shiba',
        //     'retriever',
        //     'poodle',
        //     'pomeranian',
        //     'malamute',
        //     'husky',
        //     'doberman',
        //     'corgi',
        //     'bulldog',
        //     'bullterrier',
        //     'chihuahua',
        //     'dalmatian',
        //     'finnish',
        //     'germanshepherd',
        //     'labrador',
        //     'pitbull'
        // ];
        
        $dog = 'bulldog';
            
        $response = Http::get('https://dog.ceo/api/breed/' . $dog . '/images/random/50');
        $imageData = $response->json();

        $count_image = count($imageData['message']);
        for ($i = 0; $i < $count_image; $i++) {

            $fileContents = file_get_contents($imageData['message'][$i]);

            $fileName = $dog . $i . '.jpg'; // Provide a desired file name

            Storage::disk('public')->put('anjing/'.$dog.'/'.$fileName, $fileContents);

        }
        
    }
}
