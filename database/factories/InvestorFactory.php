<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Investor;
use Faker\Generator as Faker;

$factory->define(Investor::class, function (Faker $faker) {
    $investortype = array('Accredited','Not Accredited');
    return [
        'Investor_name' => $faker->name,
        'Investor_type' => array_random($investortype),
    ];
});
