<?php

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

$factory->define(App\Models\Profile::class, function (Faker\Generator $faker) {
    return [
        'full_name'     => $faker->name,
        'occupation'    => $faker->jobTitle,
        'date_of_birth' => $faker->dateTimeThisCentury(
            $max = 'now',
            $timezone = date_default_timezone_get()
        ),
        'phone'         => $faker->phoneNumber,
        'user_id'       => 1,
    ];
});

$factory->define(App\Models\Asset::class, function (Faker\Generator $faker) {
    $startingBalance = mt_rand(1, 100000);
    return [
        'name'              => $faker->name,
        'user_id'           => 1,
        'starting_balance'  => $startingBalance,
        'balance'           => $startingBalance,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->name,
        'description'   => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'tag_id'        => mt_rand(1, 2),
        'user_id'       => 1,
    ];
});

$factory->define(App\Models\Expense::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id' => mt_rand(1, 50),
        'user_id'     => 1,
        'asset_id'    => mt_rand(1, 5),
        'date'        => $faker->dateTimeThisDecade(
            $max = 'now',
            $timezone = date_default_timezone_get()
        ),
        'amount'      => mt_rand(1, 5000)
    ];
});

$factory->define(App\Models\Income::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id' => mt_rand(1, 50),
        'user_id'     => 1,
        'asset_id'    => mt_rand(1, 5),
        'date'        => $faker->dateTimeThisDecade(
            $max = 'now',
            $timezone = date_default_timezone_get()
        ),
        'amount'      => mt_rand(5000, 10000)
    ];
});
