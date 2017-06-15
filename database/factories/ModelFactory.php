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

$factory->define(App\Models\LiquidAsset::class, function (Faker\Generator $faker) {
    $userId = mt_rand(1, 5);
    $startingBalance = mt_rand(1, 100000);

    return [
        'name'              => $faker->name,
        'user_id'           => $userId,
        'starting_balance'  => $startingBalance,
        'balance'           => $startingBalance,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    $tagId = mt_rand(1, 2);
    $userId = mt_rand(1, 5);
    $date = new Carbon();

    return [
        'name'          => $faker->name,
        'description'   => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'tag_id'        => $tagId,
        'user_id'       => $userId,
    ];
});

$factory->define(App\Models\Expense::class, function (Faker\Generator $faker) {
    $randomDays = mt_rand(1, 28);
    $randomMonths = mt_rand(1, 12);
    $randomYears = mt_rand(2000, 2017);
    $categoryId = mt_rand(1, 100);
    $userId = mt_rand(1, 5);
    $assetId = mt_rand(1, 20);
    $date = new Carbon();

    $date->day($randomDays);
    $date->month($randomMonths);
    $date->year($randomYears);

    return [
        'name'            => $faker->name,
        'description'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id'     => $categoryId,
        'user_id'         => $userId,
        'liquid_asset_id' => $assetId,
        'date'            => $date,
        'amount'          => mt_rand(1, 5000)
    ];
});


$factory->define(App\Models\Income::class, function (Faker\Generator $faker) {
    $randomDays = mt_rand(1, 28);
    $randomMonths = mt_rand(1, 12);
    $randomYears = mt_rand(2000, 2017);
    $categoryId = mt_rand(1, 100);
    $userId = mt_rand(1, 5);
    $assetId = mt_rand(1, 20);
    $date = new Carbon();

    $date->day($randomDays);
    $date->month($randomMonths);
    $date->year($randomYears);

    return [
        'name'            => $faker->name,
        'description'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id'     => $categoryId,
        'user_id'         => $userId,
        'liquid_asset_id' => $assetId,
        'date'            => $date,
        'amount'          => mt_rand(1, 5000)
    ];
});


$factory->define(App\Models\Income::class, function (Faker\Generator $faker) {
    $randomDays = mt_rand(1, 28);
    $randomMonths = mt_rand(1, 12);
    $randomYears = mt_rand(2000, 2017);
    $categoryId = mt_rand(1, 100);
    $userId = mt_rand(1, 5);
    $assetId = mt_rand(1, 20);
    $date = new Carbon();

    $date->day($randomDays);
    $date->month($randomMonths);
    $date->year($randomYears);

    return [
        'name'            => $faker->name,
        'description'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'category_id'     => $categoryId,
        'user_id'         => $userId,
        'liquid_asset_id' => $assetId,
        'date'            => $date,
        'amount'          => mt_rand(1, 5000)
    ];
});
