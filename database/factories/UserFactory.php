<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'membership_id' => App\Membership::TYPE_SILVER,
    ];
});

$factory->define(App\Server::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'user_id' => factory('App\User')->create()->id,
        'website' => $faker->url,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\ServerClick::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
    ];
});

$factory->define(App\ServerVote::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
    ];
});