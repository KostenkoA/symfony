<?php

namespace App\Model;


class InfoCommit
{
    private $message;
    private $author;
    private $hash;

    public static function fromArray(array $data)
    {
        return new self (

            $data['hash'] ?? '',
            $data['author'] ?? '',
             $data['message'] ?? ''
        );
    }

    public function __construct(string $hash, string $author, string $message)
    {
        $this->hash = $hash;
        $this->author = $author;
        $this->message = $message;
    }

     /**
      * @return string
      */
     public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}