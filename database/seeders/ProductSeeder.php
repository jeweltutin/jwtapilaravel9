<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Rice',
            'price' => '80',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit incidunt necessitatibus aperiam reiciendis eius tenetur vitae possimus dolorem voluptas veniam molestias laboriosam dicta, quaerat magni inventore placeat excepturi eligendi.'
        ]);

        Product::create([
            'name' => 'Oil',
            'price' => '1200',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit incidunt necessitatibus aperiam reiciendis eius tenetur vitae possimus dolorem voluptas veniam molestias laboriosam dicta, quaerat magni inventore placeat excepturi eligendi.'
        ]);

        Product::create([
            'name' => 'Egg',
            'price' => '200',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit incidunt necessitatibus aperiam reiciendis eius tenetur vitae possimus dolorem voluptas veniam molestias laboriosam dicta, quaerat magni inventore placeat excepturi eligendi.'
        ]);

        Product::create([
            'name' => 'Beef',
            'price' => '750',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit incidunt necessitatibus aperiam reiciendis eius tenetur vitae possimus dolorem voluptas veniam molestias laboriosam dicta, quaerat magni inventore placeat excepturi eligendi.'
        ]);

        Product::create([
            'name' => 'Chicken',
            'price' => '400',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit incidunt necessitatibus aperiam reiciendis eius tenetur vitae possimus dolorem voluptas veniam molestias laboriosam dicta, quaerat magni inventore placeat excepturi eligendi.'
        ]);

        Product::create([
            'name' => 'Banana',
            'price' => '120',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit incidunt necessitatibus aperiam reiciendis eius tenetur vitae possimus dolorem voluptas veniam molestias laboriosam dicta, quaerat magni inventore placeat excepturi eligendi.'
        ]);
    }
}


