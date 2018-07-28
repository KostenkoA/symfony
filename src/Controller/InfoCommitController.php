<?php

namespace App\Controller;

use App\Repository\infoCommit\RepositoryInfoInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class InfoCommitController extends AbstractController
{
    private $commit;

    /**
     * InfoCommitController constructor.
     * @param RepositoryInfoInterface $info
     */
    public function __construct(RepositoryInfoInterface $info)
    {
        $this->commit = $info;
    }

    /**
     * @param string $nameAndRepo
     * @return Response
     */
    public function gitCommitsList(string $nameAndRepo): Response
    {
        $commits = $this->commit->getCommits($nameAndRepo);

        return $this->render('/infoCommit/index.html.twig', [
            'commits' => $commits,
        ]);
    }
}