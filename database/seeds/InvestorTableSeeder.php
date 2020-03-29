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
        factory(App\Investor::class, 10)->create()->each(function ($investor) {
            $investor->make();
        });
    }
}
