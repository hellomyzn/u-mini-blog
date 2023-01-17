<?php

namespace App\Services;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
// use Illuminate\Pagination\LengthAwarePaginator;

// use Carbon\Carbon;

use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;


class BlogService
{    
    
    /**
     * blogRepo
     *
     * @var BlogRepositoryInterface
     */
    protected $blogRepo;

    /**
     * userRepo
     *
     * @var UserRepositoryInterface
     */
    protected $userRepo;
    
    /**
     * commentRepo
     *
     * @var CommentRepositoryInterface
     */
    protected $commentRepo;

    /**
     * __construct
     *
     * @param  BlogRepositoryInterface
     * @param  UserRepositoryInterface
     * @param  CommentRepositoryInterface
     * @return void
     */
    public function __construct(
        BlogRepositoryInterface $blogRepository,
        UserRepositoryInterface $userRepository,
        CommentRepositoryInterface $commetnRepository
    )
    {  
        $this->blogRepo = $blogRepository;
        $this->userRepo = $userRepository;
        $this->commentRepo = $commetnRepository;
    }

    static function toArrayWithUser(Blog $blog): array
    {
        $created_at = $blog->created_at->format('Y年m月d日');
        $updated_at = $blog->updated_at->format('Y年m月d日');

        $data = [
            'id' => $blog->id,
            'title' => $blog->title,
            'body' => $blog->body,
            'created_at' => $created_at,
            'updated_at' => $updated_at == $created_at ? null : "(" . $updated_at . " 更新)",
            'user_name' => is_null($blog->user) ? 'No User' : $blog->user->name,
            'comments_count' => $blog->comments_count,
        ];
        return $data;
    }

    public function getArrayWithUser(Blog $blog): array
    {
        $blog = BlogService::toArrayWithUser($blog);
        return $blog;
    }

    /**
     * get all blogs with user name
     *
     * @return Collection | array
     */
    public function getAllWithUser(): Collection | array
    {
        $blogs = $this->blogRepo->getOnlyPublic();

        $blogsWithUser = $blogs->map(function ($blog, $key){
            $data = BlogService::toArrayWithUser($blog);
            return $data;
        });

        return $blogsWithUser;
    }

    public function getComments(int $blog_id): Collection | array
    {
        
        $comments = $this->commentRepo->getByBlogId($blog_id);
        $commentsArray = $comments->map(function ($comment, $key){
            
            $created_at = $comment->created_at->format('Y年m月d日');
            $updated_at = $comment->updated_at->format('Y年m月d日');
            
            $data = [
                "id" => $comment->id,
                "body" => $comment->body,
                "user_name" => $comment->user_name,
                "created_at" => $created_at,
                "updated_at" => $updated_at,
            ];
            return $data;
        });

        return $commentsArray;
    }

}
