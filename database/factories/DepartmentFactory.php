<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Department;
use Faker\Generator as Faker;
$factory->define(Department::class, function (Faker $faker) {
    return [
        'code' => $faker->lexify('???'),
        'name' => $name = $faker->unique()->sentence(3),
        'slug' => str_slug($name),
        'level'=> $faker->numerify('#'),
    ];
});
