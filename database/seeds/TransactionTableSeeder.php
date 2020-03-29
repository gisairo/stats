<?php

use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $realinvestorcount = App\Investor::all()->count();
        $investorcount = 10;
        $investmenttypes = ['credit', 'debit'];
        //insert investment records for each investor
        for ($a=0; $a < $realinvestorcount; $a++) { 
            //ensure each investor has atleast 5 investments
            for ($i=0; $i < 5 ; $i++) { 
                DB::table('transactions')->insert([
                    'product_id'  => App\Product::select('id')->orderByRaw("RAND()")->first()->id,
                    'investor_id' => App\Investor::select('id')->orderByRaw("RAND()")->first()->id, 
                    'investment_type' => array_random($investmenttypes),
                    'amount' => rand(0,10000000),
                    'created_at'  => date("Y-m-d H:i:s"),
                ]);
            }
        }
    }
}
