<?php

use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title'=> join(' ', $faker->words),
        'content'=> '<p>'. join('</p><p>', $faker->sentences ).'</p>'
    ];
});
