<?php

use Illuminate\Database\Seeder;

class InvestorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Investor::class, 30000)->create()->each(function ($investor) {
            $investor->make();
        });
    }
}
