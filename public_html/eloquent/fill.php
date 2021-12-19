<?php

include 'init.php';

$faker = Faker\Factory::create('ru_RU');

for($i=0; $i < 30; $i++)
{
    $user = new User();
    $user->name = $faker->name;
    $user->password = $faker->password;
    $user->register_date = $faker->dateTime;
    $user->email = $faker->email;
    $user->save();
}

$users = User::all();

foreach ($users as $user) {
    for ($i = 0; $i < 5; $i++) {
        $post = new Post();
        $post->text = $faker->text;
        $post->date = $faker->dateTime;
        $post->user_id = $user->id;
        $post->isset_image = 0;
        $post->save();
    }
}