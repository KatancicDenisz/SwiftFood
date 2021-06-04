<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->truncate();
         DB::table('orders')->truncate();
         DB::table('items')->truncate();
         DB::table('categories')->truncate();
         DB::table('ordered_items')->truncate();

         //Alap user készitése
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@szerveroldali.hu',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'is_admin' => true,
            'remember_token' => Str::random(10)
        ]);

         //Item::factory(5)->create();
         $this->call([CategorySeeder::class,ItemSeeder::class,UserSeeder::class]);
                //Itemek rendelése kategoriákhoz
        Category::find(1)->items()->attach([1,2,3]);  //Pizzák
        Category::find(2)->items()->attach([4,5,6,7]);  //Édességek
        Category::find(3)->items()->attach([8,9]);  //Levesek
        Category::find(4)->items()->attach([10,11,12,13,14]);  //Húsok
        Category::find(5)->items()->attach([15,16,17,18,19]);  //Pizzák
    }
}
