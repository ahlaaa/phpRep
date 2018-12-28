<?php

namespace App\Repositories;

use App\Models\Order;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version January 26, 2018, 12:55 pm CST
 *
 * @method Order findWithoutFail($id, $columns = ['*'])
 * @method Order find($id, $columns = ['*'])
 * @method Order first($columns = ['*'])
*/
class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'qty',
        'status',
        'updated_user_id',
        'updated_user_name',
        'created_user_id',
        'created_user_name',
        'otype',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }
}
