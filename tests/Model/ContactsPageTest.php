<?php

namespace App\Tests\Model;

use App\Model\ContactsPage;
use PHPUnit\Framework\TestCase;

class ContactsPageTest extends TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Email cannot be empty
     */
    public function testCreateInstance()
    {
        new ContactsPage('', '');
    }
}