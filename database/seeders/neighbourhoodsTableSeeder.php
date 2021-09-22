<?php

namespace Database\Seeders;

use DB;

use Illuminate\Database\Seeder;

class NeighbourhoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('neighbourhoods')->insert([
            [
                'name' => 'High Park',
                'subtitle' => 'West Toronto',
                'description' => 'Sandwiched between Roncesvalles and Bloor West, this neighbourhood offers a nice park with a short subway ride to downtown',
                'image' => 'high_park.jpeg',
                'display_order' => 1
            ],
            [
                'name' => 'Greektown',
                'subtitle' => 'East Toronto',
                'description' => 'A quaint Greek inspired arrea with a connection to the Don Valley Parkway',
                'image' => 'greektown.jpeg',
                'display_order' => 2
            ],
            [
                'name' => 'Fort York',
                'subtitle' => 'South Toronto',
                'description' => 'Close to Toronto\'s Harbour front, this is a fairly new area with a booming condo presence',
                'image' => 'fort_york.jpeg',
                'display_order' => 3
            ]
            ]);
    }
}
