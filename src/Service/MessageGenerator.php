<?php

namespace App\Service;

use Faker\Factory;

class MessageGenerator
{
    public function generate(): string
    {
        $faker = Factory::create();

        return $faker->sentence();
    }
}