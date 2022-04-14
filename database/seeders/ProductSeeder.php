<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * The current faker instance
     * 
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * New Seeder instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * New Faker instance
     * 
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfProductsToCreate = 15;

        for ($i = 0; $i < $numberOfProductsToCreate; $i++) {
            Product::create([
                'product_image' => $this->faker->image('public/storage/products_images', 800, 600, null, false),
                'product_name' => Str::random(10),
                'product_description' => Str::random(100),
                'product_price' => rand(15, 2000) / 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
