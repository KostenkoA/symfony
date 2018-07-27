<?php

namespace App\Controller;

use App\Repository\infoCommit\infoCommitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class InfoCommitController extends AbstractController
{

    /**
     * @return Response|void
     */
    public function index()
    {
        $model = new infoCommitRepository();
        $model->getCommits();
//TODO need fix that
        return new Response(var_dump($model));
/*
        $model = infoCommitRepository::getCommits();
        return $this->render('/infoCommit/index.html.twig', [
            'commits' => $model,
        ]);
*/
    }
}