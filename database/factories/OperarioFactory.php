<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Operario;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Operario::class, function (Faker $faker) {
    return [
        'cedula'      =>    Str::random(10),
        'name'      =>  $faker->name,
        'apellido_pater'      =>    $faker->lastName,
        'apellido_mater'      =>    $faker->lastName,
        'direc'      => $faker->sentence,
        'tlf'      =>   $faker->phoneNumber,
        'tipo_contrato'     =>  'Indefinido',
        'tipo_licencia'     =>  'D1'
    ];
});
