<?php

namespace App\Services;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
// use Illuminate\Pagination\LengthAwarePaginator;

// use Carbon\Carbon;

use App\Repositories\Interfaces\BlogRepositoryInterface;


class BlogService
{    
    
    /**
     * blogRepo
     *
     * @var BlogRepositoryInterface
     */
    protected $blogRepo;

    /**
     * __construct
     *
     * @param  BlogRepositoryInterface
     * @param  ReservationRepositoryInterface
     * @return void
     */
    public function __construct(
        BlogRepositoryInterface $blogRepository
    )
    {  
        $this->blogRepo = $blogRepository;
    }

    /**
     * get all blogs with user name
     *
     * @return Collection | array
     */
    public function getAllWithUser(): Collection | array
    {
        $blogs = $this->blogRepo->getAll();

        $blogsWithUser = $blogs->map(function ($blog, $key){
            $created_at = $blog->created_at->format('Y年m月d日');
            $updated_at = $blog->updated_at->format('Y年m月d日');

            $data = [
                'title' => $blog->title,
                'body' => $blog->body,
                'created_at' => $created_at,
                'updated_at' => $updated_at == $created_at ? null : "(" . $updated_at . " 更新)",
                'user_name' => is_null($blog->user) ? 'No User' : $blog->user->name,
                'comments_count' => $blog->comments_count,
            ];
            return $data;
        });

        return $blogsWithUser;
    }
}
