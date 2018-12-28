<?php

namespace App\Repositories;

use App\Models\Point;

/**
 * Class PointRepository
 * @package App\Repositories
 * @version July 17, 2018, 10:22 am CST
 *
 * @method Point findWithoutFail($id, $columns = ['*'])
 * @method Point find($id, $columns = ['*'])
 * @method Point first($columns = ['*'])
*/
class PointRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'percentage',
        'point'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Point::class;
    }
}
