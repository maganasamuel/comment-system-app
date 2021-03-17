<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'message' => $faker->sentence,
    ];
})->state(App\Comment::class, 'child', function ($faker) {
    return [
        'layer' => 2,
        'parent_id' => factory(App\Comment::class)->create()->id,
    ];
});
