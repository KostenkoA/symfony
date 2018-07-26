<?php

namespace App\Controller;


use App\Model\InfoCommit;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoCommitController extends AbstractController
{
    public function index(string $nameAndRepo)
    {
        $client = new Client();
        $endpoint = 'https://api.github.com/repos/' . $nameAndRepo . '/commits';

        try {
            $response = $client->request('GET', $endpoint);
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                return 'Something went wrong!';
            }
        }
        $body = $response->getBody();
        $bodyArray = \json_decode($body, true);

        for ($i = 0; $i < count($bodyArray); $i++) {
            $model[] = InfoCommit::fromArray([
                'number' => $i,
                'hash' => \substr($bodyArray[$i]['sha'],0,7),
                'author' => $bodyArray[$i]['commit']['author']['name'],
                'message' => $bodyArray[$i]['commit']['message']
            ]);
        }

        return $this->render('/infoCommit/index.html.twig', [
            'commits' => $model,
            'count' => \count($model)
        ]);
    }
}