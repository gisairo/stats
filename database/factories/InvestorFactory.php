<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Investor;
use Faker\Generator as Faker;

$factory->define(Investor::class, function (Faker $faker) {
    $investortype = array('Accredited','Not Accredited');
    return [
        'email' => $faker->email,
        'investor_name' => $faker->name,
        'investor_type' => array_random($investortype),
        'created_at' => date("Y-m-d H:i:s"),
    ];
});
