<?php

namespace App\Repositories;

use App\Models\Express;

/**
 * Class ExpressRepository
 * @package App\Repositories
 * @version January 26, 2018, 7:07 pm CST
 *
 * @method Express findWithoutFail($id, $columns = ['*'])
 * @method Express find($id, $columns = ['*'])
 * @method Express first($columns = ['*'])
*/
class ExpressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'letter',
        'tel',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Express::class;
    }
}
