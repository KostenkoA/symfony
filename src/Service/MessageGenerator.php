<?php

namespace App\Service;

use Faker\Factory;

/**
 * Service for generating fake messages for testing.
 * @author Kostenko Anton
 * @package App\Service
 */
class MessageGenerator
{
    /**
     * @return string Fake string
     */
    public function generate(): string
    {
        $faker = Factory::create();

        return $faker->sentence();
    }
}