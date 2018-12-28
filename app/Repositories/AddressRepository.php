<?php

namespace App\Repositories;

use App\Models\Address;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version January 27, 2018, 10:43 am CST
 *
 * @method Address findWithoutFail($id, $columns = ['*'])
 * @method Address find($id, $columns = ['*'])
 * @method Address first($columns = ['*'])
*/
class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'province',
        'city',
        'county',
        'street',
        'user_id',
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
        return Address::class;
    }
}
