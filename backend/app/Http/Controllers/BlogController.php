<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Services\BlogService;


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
}
