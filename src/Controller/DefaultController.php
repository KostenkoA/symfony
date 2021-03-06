<?php

namespace App\Controller;

use App\Model\ContactsPage;
use App\Service\MessageGenerator;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private $messageGeneraror;
    private $logger;

    public function __construct(MessageGenerator $messageGeneraror, LoggerInterface $logger)
    {
        $this->messageGeneraror = $messageGeneraror;
        $this->logger = $logger;
    }

    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return new Response('Symfony4 is great');
    }

    public function contacts(): Response
    {
        $this->logger->info('User reached contacts page');

        $model = new ContactsPage('info@itea.ua', $this->messageGeneraror->generate());

        return $this->render('default/contacts.html.twig',['contacts' => $model]);
    }
}