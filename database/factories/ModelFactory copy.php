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

// User Factory
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'propic' => $faker->imageUrl($width = 300, $height = 300),
    ];
});

// Corporate User Factory
$factory->define(App\Subscription::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->realText($maxNbChars = 10, $indexSize = 2),
        'descrip' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'monthlyfee' => 200,
        'carsallowed' => $faker->randomDigit,
        'partsallowed' => $faker->randomDigit,
    ];
});

// Corporate Factory
$factory->define(App\Corporate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->email,
        'phone' => $faker->phoneNumber,
        'descrip' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'logo_url' => $faker->imageUrl($width = 640, $height = 480),
        'subscription_id' => $faker->numberBetween($min = 1, $max = 4),
        'subscriptionexpires' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

// Corporate User Factory
$factory->define(App\Corporateuser::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->jobTitle,
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Car Factory
$factory->define(App\Car::class, function (Faker\Generator $faker) {
    return [
        'plates' => $faker->colorName,
        'color' => $faker->bothify('###-???'),
        'weight' => $faker->numberBetween($min = 1, $max = 10),
        'datebought' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'make' => $faker->word,
        'model' => $faker->word,
        'bodytype' => $faker->word,
        'note' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'published' => $faker->boolean,
        'status' => $faker->randomElement($array = array ('auction','tender','rent', 'sale', 'sold')),
        'physicallocation' => $faker->country,
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Carimage Factory
$factory->define(App\Carimage::class, function (Faker\Generator $faker) {
    return [
        'car_id' => $faker->numberBetween($min = 1, $max = 30),
        'img_url' => $faker->imageUrl($width = 300, $height = 300),
        'thumb_img_url' => $faker->imageUrl($width = 100, $height = 100),
    ];
});

// Carsale Factory
$factory->define(App\Carsale::class, function (Faker\Generator $faker) {
    return [
        'car_id' => $faker->unique()->numberBetween($min = 1, $max = 30),
        'cargroup_id' => $faker->numberBetween($min = 1, $max = 10),
        'negotiable' => $faker->boolean,
        'price' => $faker->numberBetween($min = 1000, $max = 9000),
        'status' => $faker->randomElement($array = array ('sale','reserved','sold')),
        'note' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Carsaleoffer Factory
$factory->define(App\Carsaleoffer::class, function (Faker\Generator $faker) {
    return [
        'carsale_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'offer' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Carsalereserve Factory
$factory->define(App\Carsalereserve::class, function (Faker\Generator $faker) {
    return [
        'carsale_id' => $faker->numberBetween($min = 1, $max = 10),
        'carsaleoffer_id' => $faker->numberBetween($min = 1, $max = 100),
        'note' => $faker->sentence($nbWords = 7, $variableNbWords = true),
    ];
});

// Carcomment Factory
$factory->define(App\Carcomment::class, function (Faker\Generator $faker) {
    return [
        'parent_comment_id' => $faker->numberBetween($min = 1, $max = 200),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'car_id' => $faker->numberBetween($min = 1, $max = 30),
        'comment' => $faker->realText($maxNbChars = 100, $indexSize = 2),
    ];
});

// Cartail Factory
$factory->define(App\Cartail::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'car_id' => $faker->numberBetween($min = 1, $max = 30),
    ];
});

// Part Factory
$factory->define(App\Part::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'serialnumber' => $faker->bothify('###-???'),
        'descript' => $faker->sentence($nbWords = 12, $variableNbWords = true),
        'note' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'published' => $faker->boolean,
        'status' => $faker->randomElement($array = array ('auction','tender','rent', 'sale', 'sold')),
        'physicallocation' => $faker->country,
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Cargroup Factory
$factory->define(App\Cargroup::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'published' => $faker->boolean,
        'type' => $faker->randomElement($array = array ('sale','rent','auction','tender')),
        'descript' => $faker->sentence($nbWords = 12, $variableNbWords = true),
        'autopublish' => $faker->boolean,
        'autounpublish' => $faker->boolean,
        'startdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'enddate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
        'autopublishcars' => $faker->boolean,
        'autounpublishcars' => $faker->boolean,
        'autoreservecars' => $faker->boolean,
    ];
});


// Roles Factory
$factory->define(Bican\Roles\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->randomElement($array = array ('Administrator','Manager','Sales','Maintainer')),
        'slug' => $faker->unique()->randomElement($array = array ('administrator','manager','sales','maintainer')),
        'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
    ];
});

// Permissions Factory
$factory->define(Bican\Roles\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Corporate User',
        'slug' => 'corporate.user',
        'description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
    ];
});


// Carrent Factory
$factory->define(App\Carrent::class, function (Faker\Generator $faker) {
    return [
        'car_id' => $faker->unique()->numberBetween($min = 1, $max = 30),
        'cargroup_id' => $faker->numberBetween($min = 1, $max = 10),
        'rateperday' => $faker->numberBetween($min = 100, $max = 1000),
        'rateperhour' => $faker->numberBetween($min = 100, $max = 1000),
        'bondfee' => $faker->numberBetween($min = 100, $max = 1000),
        'status' => $faker->randomElement($array = array ('rent','onrent')),
        'note' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Carrentoffer Factory
$factory->define(App\Carrentoffer::class, function (Faker\Generator $faker) {
    return [
        'carrent_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'offer' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Carrentreserve Factory
$factory->define(App\Carrentreserve::class, function (Faker\Generator $faker) {
    return [
        'carrent_id' => $faker->numberBetween($min = 1, $max = 10),
        'carrentoffer_id' => $faker->numberBetween($min = 1, $max = 100),
        'note' => $faker->sentence($nbWords = 7, $variableNbWords = true),
    ];
});

// Carauction Factory
$factory->define(App\Carauction::class, function (Faker\Generator $faker) {
    return [
        'car_id' => $faker->unique()->numberBetween($min = 20, $max = 30),
        'startdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'enddate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'startbidprice' => $faker->numberBetween($min = 1000, $max = 9000),
        'cargroup_id' => $faker->numberBetween($min = 1, $max = 10),
        'status' => $faker->randomElement($array = array ('auction','reserved','sold')),
        'note' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
        'signuprequired' => $faker->boolean,
        'signupfee' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Carauctionbid Factory
$factory->define(App\Carauctionbid::class, function (Faker\Generator $faker) {
    return [
        'carauction_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'bid' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Carauctionbidder Factory
$factory->define(App\Carauctionbidder::class, function (Faker\Generator $faker) {
    return [
        'carauction_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Carauctionreserve Factory
$factory->define(App\Carauctionreserve::class, function (Faker\Generator $faker) {
    return [
        'carauction_id' => $faker->numberBetween($min = 1, $max = 10),
        'carauctionbid_id' => $faker->numberBetween($min = 1, $max = 100),
        'note' => $faker->sentence($nbWords = 7, $variableNbWords = true),
    ];
});

// Cartender Factory
$factory->define(App\Cartender::class, function (Faker\Generator $faker) {
    return [
        'car_id' => $faker->unique()->numberBetween($min = 20, $max = 30),
        'startdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'enddate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'cargroup_id' => $faker->numberBetween($min = 1, $max = 10),
        'status' => $faker->randomElement($array = array ('tender','reserved','sold')),
        'note' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
        'signuprequired' => $faker->boolean,
        'signupfee' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Cartendertender Factory
$factory->define(App\Cartendertender::class, function (Faker\Generator $faker) {
    return [
        'cartender_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'tender' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Cartendertenderer Factory
$factory->define(App\Cartendertenderer::class, function (Faker\Generator $faker) {
    return [
        'cartender_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Cartenderreserve Factory
$factory->define(App\Cartenderreserve::class, function (Faker\Generator $faker) {
    return [
        'cartender_id' => $faker->numberBetween($min = 1, $max = 10),
        'cartendertender_id' => $faker->numberBetween($min = 1, $max = 100),
        'note' => $faker->sentence($nbWords = 7, $variableNbWords = true),
    ];
});

// Partgroup Factory
$factory->define(App\Partgroup::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'published' => $faker->boolean,
        'descript' => $faker->sentence($nbWords = 12, $variableNbWords = true),
        'autopublish' => $faker->boolean,
        'autounpublish' => $faker->boolean,
        'startdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'enddate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
        'autopublishparts' => $faker->boolean,
        'autounpublishparts' => $faker->boolean,
        'autoreserveparts' => $faker->boolean,
    ];
});


// Partsale Factory
$factory->define(App\Partsale::class, function (Faker\Generator $faker) {
    return [
        'part_id' => $faker->unique()->numberBetween($min = 1, $max = 30),
        'partgroup_id' => $faker->numberBetween($min = 1, $max = 30),
        'negotiable' => $faker->boolean,
        'price' => $faker->numberBetween($min = 1000, $max = 9000),
        'status' => $faker->randomElement($array = array ('sale','reserved','sold')),
        'note' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'corporate_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

// Partimage Factory
$factory->define(App\Partimage::class, function (Faker\Generator $faker) {
    return [
        'part_id' => $faker->numberBetween($min = 1, $max = 120),
        'img_url' => $faker->imageUrl($width = 300, $height = 300),
        'thumb_img_url' => $faker->imageUrl($width = 100, $height = 100),
    ];
});

// Partsaleoffer Factory
$factory->define(App\Partsaleoffer::class, function (Faker\Generator $faker) {
    return [
        'partsale_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'offer' => $faker->numberBetween($min = 1000, $max = 9000),
    ];
});

// Partsalereserve Factory
$factory->define(App\Partsalereserve::class, function (Faker\Generator $faker) {
    return [
        'partsale_id' => $faker->numberBetween($min = 1, $max = 10),
        'partsaleoffer_id' => $faker->numberBetween($min = 1, $max = 100),
        'note' => $faker->sentence($nbWords = 7, $variableNbWords = true),
    ];
});

// Partcomment Factory
$factory->define(App\Partcomment::class, function (Faker\Generator $faker) {
    return [
        'parent_commentid' => $faker->numberBetween($min = 1, $max = 200),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'part_id' => $faker->numberBetween($min = 1, $max = 30),
        'comment' => $faker->realText($maxNbChars = 100, $indexSize = 2),
    ];
});

// Parttail Factory
$factory->define(App\Parttail::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'part_id' => $faker->numberBetween($min = 1, $max = 30),
    ];
});





