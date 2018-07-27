<?php

namespace App\Repository\infoCommit;


interface RepositoryInfoInterface
{
    public function getCommits(): ?array;
}