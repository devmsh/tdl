<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'min_candidates' => $faker->randomDigitNotNull,
        'trainer_id' => function(){
            return factory(\App\User::class)->create()->id;
        }
    ];
});
