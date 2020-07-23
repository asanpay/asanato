<?php

use Apiato\Core\Loaders\SeederLoaderTrait;
use Illuminate\Database\Seeder as LaravelSeeder;
use \Illuminate\Support\Facades\Artisan;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends LaravelSeeder
{
    //commented by Aboozar user Apiato seeders instead
    //use SeederLoaderTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //commented by Aboozar user Apiato seeders instead
        // $this->runLoadingSeeders();

        Artisan::call('apiato:seed-deploy');
        if (app()->environment() == 'testing') {
            Artisan::call('apiato:seed-test');
        }
    }
}
