<?php
/**
 * Created by PhpStorm.
 * User: SX
 * Date: 2018/1/2
 * Time: 12:31
 */

namespace App\Repositories;

use InfyOm\Generator\Common\BaseRepository as InfyOmRepository;


abstract class BaseRepository extends InfyOmRepository
{
    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $limit
     * @param array $columns
     * @param string $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $this->orderBy('id', 'desc');

        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? request()->get('pageSize', 15) : $limit;
        $results = $this->model->{$method}($limit, $columns);
        $results->appends(app('request')->query());
        $this->resetModel();

        return $this->parserResult($results);
    }

    public function status()
    {
        $status = request()->get('status');

        return $this->scopeQuery(function ($query) use ($status) {
            $query->when(isset($status), function ($query) use ($status) {
                return $query->whereStatus($status);
            });
            return $query;
        });
    }
}