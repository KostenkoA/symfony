<?php

namespace App\Model;

class ContactsPage
{
    private $email;
    private $quote;

    public function __construct(string $email, string $quote)
    {
        $this->email = $email;
        $this->quote = $quote;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getQuote(): string
    {
        return $this->quote;
    }
}