<?php

namespace App\Repositories\Comments;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
// use Illuminate\Database\Query\Builder;
// use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
// use stdClass;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentModelRepository implements CommentRepositoryInterface
{
    
    /**
     * model
     *
     * @var Comment
     */
    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * getAll
     *
     * @return Collection or array
     */
    public function getByBlogId(int $blog_id): Collection | array
    {
        try {
            return DB::transaction(function () use($blog_id){
                $comments = $this->model
                    ->where('blog_id', $blog_id)
                    ->oldest()
                    ->with('user')
                    ->get();
                
                $commentsWithUserName = $comments->map(function ($comment, $key){
                    $comment['user_name'] = $comment->user->name;
                    return  $comment;
                });

                return $commentsWithUserName;
            });
        } catch(Exception $e) {
            Log::error(__METHOD__.'@'.$e->getLine().': '.$e->getMessage());

            return [
                'msg' => $e->getMessage(),
                'err' => false,
            ];
        }
    }
}