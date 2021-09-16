<?php

namespace Database\Seeders;

use DB;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $neighbourhoods = DB::select('select * from Neighbourhoods');
        $houseIds = [];
        foreach ($neighbourhoods as $hood) {
            $houseIds[$hood->name] = $hood->id;
        }
        $highPark = $houseIds['High Park'];
        $greekTown = $houseIds['Greektown'];
        $fortYork = $houseIds['Fort York'];

        DB::table('houses')->insert([
            
            [
                'name' => '50 High Park Road',
                'neighbourhood' => 1,
                'image' => '50highpark.jpg',
                'description' => 'Steps away from the subway.',
                'price' => 2000,
                'propertyType' => 'Detached',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '100 High Park Road',
                'neighbourhood' => 1,
                'image' => '100highpark.jpg',
                'description' => 'Around the corner of glenlake road',
                'price' => 2200,
                'propertyType' => 'Semi-Detached',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '66 Pacific Road',
                'neighbourhood' => 1,
                'image' => '66pacific.jpg',
                'description' => 'Right by the tennis courts',
                'price' => 1700,
                'propertyType' => 'Condo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => '87 Logan Avenue',
                'neighbourhood' => 2,
                'image' => '87loganavenue.jpg',
                'description' => 'Close to the fountain',
                'price' => 1400,
                'propertyType' => 'Condo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => '42 Broadview Avenue',
                'neighbourhood' => 2,
                'image' => '42broadviewavenue.jpg',
                'description' => 'By the bridge',
                'price' => 1900,
                'propertyType' => 'Townhouse',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => '45 Danforth Avenue',
                'neighbourhood' => 2,
                'image' => '45danforthavenue.jpg',
                'description' => 'In the core of the neighbourhood',
                'price' => 2400,
                'propertyType' => 'Semi-Detached',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => '402 10 Bathurst Street',
                'neighbourhood' => 3,
                'image' => '10bathurststreet.jpg',
                'description' => 'Nice condo in the core',
                'price' => 2400,
                'propertyType' => 'Detached',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => '34 Lakeshore West.',
                'neighbourhood' => 3,
                'image' => '34lakeshorewest.jpg',
                'description' => 'By the harbourfront',
                'price' => 2800,
                'propertyType' => 'Townhouse',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => '10 Lower Spadina',
                'neighbourhood' => 3,
                'image' => '10lowerspadina.jpg',
                'description' => 'Same building as Starbucks',
                'price' => 2300,
                'propertyType' => 'Condo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
                  
        ]);
    }
}
