<?php

namespace App\Repositories\Users;

use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Collection;
// use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
// use stdClass;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserModelRepository implements UserRepositoryInterface
{
    
    /**
     * model
     *
     * @var User
     */
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getById(int $id): Model | array
    {
        try {
            return DB::transaction(function () use($id) {
                $user = $this->model->findOrFail($id);

                return $user;
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