<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index()
    {
        return new Response('Symfony4 is great');
    }

    public function contacts()
    {
        return $this->render('default/index.html.twig');
    }
}