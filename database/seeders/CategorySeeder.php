<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = [ ['name'=>'Pizzák'],['name'=>'Édességek'],['name'=>'Levesek'],['name'=>'Hús ételek'], ['name'=>'Halak']];

       foreach ($categories as $category) {
           Category::create($category);
       }
    }
}
