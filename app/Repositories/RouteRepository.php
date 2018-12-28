<?php

namespace App\Repositories;

use App\Models\Route;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class RouteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Route::class;
    }
}
