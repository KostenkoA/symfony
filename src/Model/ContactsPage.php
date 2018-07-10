<?php

namespace App\Model;

/**
 * Model for contacts page
 *
 * @author Kostenko Anton <kostenko.antony@gmail.com>
 */
class ContactsPage
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $quote;

    /**
     * ContactsPage constructor.
     * @param string $email
     * @param string $quote
     *
     * @throws \RuntimeException If email is empty
     */
    public function __construct(string $email, string $quote)
    {
        if (empty($email)){
            throw new \RuntimeException('Email cannot be empty');
        }

        $this->email = $email;
        $this->quote = $quote;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getQuote(): string
    {
        return $this->quote;
    }
}