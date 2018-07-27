<?php

namespace App\Controller;

use App\Repository\infoCommit\gitCommitRepository;
use App\Repository\infoCommit\RepositoryInfoInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class InfoCommitController extends AbstractController
{

    public function gitCommitsList(string $nameAndRepo)
    {
        $gitCommitsList = new gitCommitRepository($nameAndRepo);
        $commits = $gitCommitsList->getCommits();

        return $this->render('/infoCommit/index.html.twig', [
            'commits' => $commits,
        ]);
    }
}