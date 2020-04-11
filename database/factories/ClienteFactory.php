<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'cedula' => Str::random(10),
        'name' => $faker->name,
        'apellido_pater' => $faker->lastName,
        'apellido_mater' => $faker->lastName,
        'direc' => $faker->sentence,
        'tlf' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => Str::random(10),
    ];
});
