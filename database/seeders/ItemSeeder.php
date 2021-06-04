<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Sajtimádó',
                'description' => 'Friss, omlós, extra sajtos pizza, paradicsom alappal',
                'price' => 1700,
                'image_url' =>  'pizza.jpg'
            ],
            [
                'name' => 'Kolbászparty',
                'description' => 'Kolbásszal megszórt, paradicsomszósz alapú sajtos pizza',
                'price' => 1900,
                'image_url' =>  'sausage_pizza.jpg'
            ],
            [
                'name' => 'Chilipizza',
                'description' => 'Kolbászos pizza csipős paprikával',
                'price' => 2199,
                'image_url' =>  'peperoni.jpg'
            ],
            [
                'name' => 'Amerikai palacsinta',
                'description' => 'Töltelékes palacsinta juhar sziruppal',
                'price' => 250,
                'image_url' =>  'pancakes.jpg'
            ],
            [
                'name' => 'Brownie',
                'description' => 'Omlós csokiöntetes, csokival töltött brownie',
                'price' => 600,
                'image_url' =>  'brownie.jpg'
            ],
            [
                'name' => 'Baklava',
                'description' => 'Mézédes kakaós vagy idós baklava',
                'price' => 300,
                'image_url' =>  'baklava.jpg'
            ],
            [
                'name' => 'Rendőrök kedvence',
                'description' => 'Több ízű tökéletes fánk',
                'price' => 200,
                'image_url' =>  'donut.jpg'
            ],
            [
                'name' => 'Savanyú leves',
                'description' => 'Zöldésges, marhahúsos savanyú leves',
                'price' => 500,
                'image_url' =>  'soup1.jpg'
            ],
            [
                'name' => 'A vasárnapi szokásos',
                'description' => 'Otthonba repítő, szívet melengető húsleves',
                'price' => 599,
                'image_url' =>  'soup2.jpg'
            ],
            [
                'name' => 'Gyro-600',
                'description' => 'Egy jó buli mindig gyrossal végződik',
                'price' => 600,
                'image_url' =>  'gyros.jpg'
            ],
            [
                'name' => 'Hambibambi',
                'description' => 'Dupla húsos, chedar sajtos, hagymás, uborkás, ketchupos, omlós hambi',
                'price' => 1500,
                'image_url' =>  'hambi.jpg'
            ],
            [
                'name' => 'Steak Ramsey módra',
                'description' => 'A gazdagok kihagyhatatlan eledele',
                'price' => 3000,
                'image_url' =>  'steak.jpg'
            ],
            [
                'name' => 'Tenyeres Schnitzel',
                'description' => 'Akkora, hogy a tányérodról mindig le fog esni a sültburgonya vágás közben',
                'price' => 1300,
                'image_url' =>  'chicken.jpg'
            ],
            [
                'name' => 'Spagetti',
                'description' => 'Bolonyai spagetti',
                'price' => 1599,
                'image_url' =>  'bolognai.jpg'
            ],
            [
                'name' => 'Lazac',
                'description' => 'Friss lazac',
                'price' => 2300,
                'image_url' =>  'salmon.jpg'
            ],
            [
                'name' => 'Sült ponty',
                'description' => 'Filézett sült ponty',
                'price' => 1700,
                'image_url' =>  'fish.jpg'
            ],
            [
                'name' => 'Sushi',
                'description' => 'Sushi, ahogy a japánok szeretik',
                'price' => 2699,
                'image_url' =>  'sushi.jpg'
            ],
            [
                'name' => 'Koktélrák',
                'description' => 'Imádnivaló koktélrákok salátával',
                'price' => 1900,
                'image_url' =>  'shrimp.jpg'
            ],
            [
                'name' => 'Sárgarépás hal',
                'description' => 'Répás hal',
                'price' => 1800,
                'image_url' =>  null,
            ]
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
