<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Student;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Student::class, function (Faker $faker) {
    return [
        'student_no' => $faker->creditCardNumber,
        'fname' => $faker->name,
        'lname' => $faker->name,
    ];
});
