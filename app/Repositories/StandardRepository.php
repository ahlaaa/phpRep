<?php

namespace App\Repositories;

use App\Models\Standard;

/**
 * Class StandardRepository
 * @package App\Repositories
 * @version July 9, 2018, 4:15 pm CST
 *
 * @method Standard findWithoutFail($id, $columns = ['*'])
 * @method Standard find($id, $columns = ['*'])
 * @method Standard first($columns = ['*'])
*/
class StandardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'name',
        'father_name',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Standard::class;
    }
}
