<?php

namespace App\Repositories;

use App\Models\Factory;

/**
 * Class FactoryRepository
 * @package App\Repositories
 * @version January 22, 2018, 9:36 pm CST
 *
 * @method Factory findWithoutFail($id, $columns = ['*'])
 * @method Factory find($id, $columns = ['*'])
 * @method Factory first($columns = ['*'])
*/
class FactoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'img_promise',
        'img_qualification',
        'img_scene',
        'name',
        'address',
        'linkman',
        'telephone',
        'white_book',
        'updated_user_id',
        'updated_user_name',
        'created_user_id',
        'created_user_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Factory::class;
    }
}
