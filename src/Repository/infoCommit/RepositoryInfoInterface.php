<?php

namespace App\Repository\infoCommit;


interface RepositoryInfoInterface
{
    /**
     * @param string $nameAndRepo
     * @return array|null
     */
    public function getCommits(string $nameAndRepo): ?array;
}