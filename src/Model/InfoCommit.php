<?php

namespace App\Model;


class InfoCommit
{
    private $number;
    private $message;
    private $author;
    private $hash;

    public static function fromArray(array $data)
    {
        return new self (
            $data['number'] ?? 0,
            $data['hash'] ?? '',
            $data['author'] ?? '',
            $data['message'] ?? ''
        );
    }

    public function __construct(int $number, string $hash, string $author, string $message)
    {
        $this->number = $number;
        $this->hash = $hash;
        $this->author = $author;
        $this->message = $message;
    }

    /**
     * @return int
     */
     public function getNumber(): int
     {
         return $this->number;
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