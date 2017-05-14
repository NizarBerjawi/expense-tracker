<?php
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Expense::class, function (Faker\Generator $faker) {
    $randomDays = mt_rand(1, 12);
    $date = new Carbon();

    return [
        'name'          => $faker->name,
        'description'   => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id'   => null,
        'user_id'       => 1,
        'date'          => $date->month($randomDays),
        'amount'        => mt_rand(1, 50000)
    ];
});


$factory->define(App\Models\Income::class, function (Faker\Generator $faker) {
    $randomDays = mt_rand(1, 12);
    $date = new Carbon();

    return [
        'name'          => $faker->name,
        'description'   => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id'   => null,
        'user_id'       => 1,
        'date'          => $date->month($randomDays),
        'amount'        => mt_rand(1, 50000)
    ];
});
