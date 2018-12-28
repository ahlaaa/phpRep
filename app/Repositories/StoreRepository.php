<?php

namespace App\Repositories;

use App\Models\Store;

/**
 * Class StoreRepository
 * @package App\Repositories
 * @version July 9, 2018, 11:01 am CST
 *
 * @method Store findWithoutFail($id, $columns = ['*'])
 * @method Store find($id, $columns = ['*'])
 * @method Store first($columns = ['*'])
*/
class StoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'telephone',
        'name',
        'address',
        'user.name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Store::class;
    }
}
