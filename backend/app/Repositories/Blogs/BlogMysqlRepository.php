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

class BlogMysqlRepository implements BlogRepositoryInterface
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
     * @return Collection
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
        
   
}