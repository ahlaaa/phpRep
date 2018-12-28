<?php
namespace App\Criteria;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UserCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('id', '>', 1);
        return $model;
    }
}