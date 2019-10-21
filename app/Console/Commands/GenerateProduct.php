<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;

class GenerateProduct extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:product {count} {min=100} {max=200}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init {count} of products';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command. Args count, min, max. No validation
     *
     * @return mixed
     */
    public function handle() {
        $count_of_products = $this->argument('count');
        $min_price = $this->argument('min');
        $max_price = $this->argument('max');
        
        for ($index = 0; $index < $count_of_products; $index++) {
            $price = mt_rand($min_price * 100, $max_price * 100) / 100;
            $name = 'Product ' . md5(uniqid(rand(), true));
            $product = Product::firstOrCreate([
                'name' => $name, 
                'price' => $price
            ]);
            
        }
        $this->info("$count_of_products products generated");
    }

}
