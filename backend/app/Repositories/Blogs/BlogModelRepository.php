<?php

namespace App\Repositories\Blogs;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
// use Illuminate\Database\Query\Builder;
// use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
// use stdClass;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogModelRepository implements BlogRepositoryInterface
{
    
    /**
     * model
     *
     * @var Blog
     */
    protected $model;

    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /**
     * getAll
     *
     * @return Collection or array
     */
    public function getAll(): Collection | array
    {
        try {
            return DB::transaction(function () {
                return $this->model
                    ->with('user')
                    ->withCount('comments')
                    ->latest()
                    ->get();
            });
        } catch(Exception $e) {
            Log::error(__METHOD__.'@'.$e->getLine().': '.$e->getMessage());

            return [
                'msg' => $e->getMessage(),
                'err' => false,
            ];
        }
    }

    /**
     * getOnlyPublic
     *
     * @return Collection or array
     */
    public function getOnlyPublic(): Collection | array
    {
        try {
            return DB::transaction(function () {
                return $this->model
                    ->with('user')
                    ->withCount('comments')
                    ->OnlyPublic()
                    ->latest()
                    ->get();
            });
        } catch(Exception $e) {
            Log::error(__METHOD__.'@'.$e->getLine().': '.$e->getMessage());

            return [
                'msg' => $e->getMessage(),
                'err' => false,
            ];
        }
    }

    public function getComments(int $blog_id): Collection | array
    {
        try {
            return DB::transaction(function () use($blog_id) {
                $blog = $this->model->with('comments')->findOrFail($blog_id);
                $comments = $blog->comments;
                return $comments;
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