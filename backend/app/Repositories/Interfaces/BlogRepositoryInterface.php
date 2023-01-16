<?php

namespace App\Repositories\Interfaces;

interface BlogRepositoryInterface
{
    public function getAll();
    public function getOnlyPublic();
}