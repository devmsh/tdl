<?php

use Faker\Generator as Faker;

$factory->define(App\Interest::class, function (Faker $faker) {
    return [
        'course_id' => function(){
            return factory(\App\Course::class)->create()->id;
        }
    ];
});
