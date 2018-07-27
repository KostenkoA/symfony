<?php

namespace App\Repository\infoCommit;

use App\Model\InfoCommit;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class gitCommitRepository
{
    public $collectionCommit;

    public function __construct($nameAndRepo)
    {
        $this->collectionCommit = $this->getCommits($nameAndRepo);
    }
    private function getCommits(string $nameAndRepo)
    {
        $client = new Client();
        $mainUri = 'https://api.github.com/repos';
        $endpoint = 'commits';

        try {
            $response = $client->request('GET', \sprintf('%s/%s/%s', $mainUri, $nameAndRepo,
                $endpoint));
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                throw new \LogicException('Incorrectly put name OR repository');
            }
        }
        $body = $response->getBody();
        $bodyArray = \json_decode($body, true);

        for ($i = 0; $i < count($bodyArray); $i++) {
            $collectionCommit[] = InfoCommit::fromArray([
                'hash' => \substr($bodyArray[$i]['sha'], 0, 7),
                'author' => $bodyArray[$i]['commit']['author']['name'],
                'message' => $bodyArray[$i]['commit']['message']
            ]);
        }

        return $collectionCommit;
    }

    /**
     * @return mixed
     */
    public function getCollectionCommit()
    {
        return $this->collectionCommit;
    }
}