<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Services\BlogService;
use App\Models\Blog;


class BlogController extends Controller
{
    /**
     * blogService
     *
     * @var [type]
     */
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }


    public function index()
    {
        $blogs = $this->blogService->getAllWithUser();
        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        abort_unless($blog->is_public, 403);
        $blog = $this->blogService->getArrayWithUser($blog);
        $comments = $this->blogService->getComments($blog['id']);

        return view('blogs.show', compact('blog', 'comments'));
    }
}
