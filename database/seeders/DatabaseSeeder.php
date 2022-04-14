<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Symlink storage directory
        \Illuminate\Support\Facades\Artisan::call('storage:link');

        // Weird fix for the seeder error 'unable to create the directory...'
        Storage::deleteDirectory('public/products_images');
        Storage::makeDirectory('public/products_images');

        $this->call([
            UserSeeder::class,
            ProductSeeder::class
        ]);
    }
}
