<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Siswa::class, function (Faker $faker) {
    return [
        'nisn' => $faker->isbn13,
        'nama_depan' => $faker->name,
        'nama_belakang' => $faker->lastName,
        'jenis_kelamin' => $faker->randomElement($array = ['L','P']),
        'agama' => $faker->randomElement($array = ['Islam', 'Kristen','Katolik','Hindu','Budha']),
        'alamat' => $faker->address,
        'avatar' => 'default.jpg',
        'email' => $faker->email,
    ];
});
