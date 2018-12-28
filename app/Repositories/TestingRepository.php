<?php

namespace App\Repositories;

use App\Models\Testing;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TestingRepository
 * @package App\Repositories
 * @version September 9, 2018, 7:56 am CST
 *
 * @method Testing findWithoutFail($id, $columns = ['*'])
 * @method Testing find($id, $columns = ['*'])
 * @method Testing first($columns = ['*'])
*/
class TestingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Testing::class;
    }
}
