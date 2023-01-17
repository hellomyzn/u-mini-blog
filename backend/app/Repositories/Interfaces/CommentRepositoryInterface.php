<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function getByBlogId(int $id);
}