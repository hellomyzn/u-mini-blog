<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\Blog;
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
        $blog = $this->blogRepo->getAll();
        return view('index');
    }
}
