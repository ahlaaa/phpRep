<?php

namespace App\Repositories;

use App\Models\Tourist;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class TouristRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'user_id',
        'name',
        'route_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tourist::class;
    }
}
