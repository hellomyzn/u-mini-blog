<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Repositories\Interfaces\BlogRepositoryInterface;


class BlogController extends Controller
{
    /**
     * blogRepo
     *
     * @var [type]
     */
    protected $blogRepo;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepo = $blogRepository;
    }


    public function index()
    {
        $blogs = $this->blogRepo->getAll();
        return view('blogs.index', compact('blogs'));
    }
}
