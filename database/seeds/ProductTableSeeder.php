<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
               'KarenHeights', 'LangataSingleHomes', 'KilimaniTowers', 
               'LimuruHolidayHomes', 'VoiVillas', 'NgaraStudentHostels',
               'RongaiHotels', 'BeachRetreat', 'KiambuGolfEstate',
               'KajiadoRanchHouses'
        );
        for ($i=0; $i < 10 ; $i++) { 
            DB::table('products')->insert([
                'name' => $products[$i],
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        
    }
}
