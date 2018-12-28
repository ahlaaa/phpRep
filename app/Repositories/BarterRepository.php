<?php

namespace App\Repositories;

use App\Models\Barter;

/**
 * Class BarterRepository
 * @package App\Repositories
 * @version July 26, 2018, 9:33 am CST
 *
 * @method Barter findWithoutFail($id, $columns = ['*'])
 * @method Barter find($id, $columns = ['*'])
 * @method Barter first($columns = ['*'])
*/
class BarterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'address_id',
        'user_name',
        'user_id',
        'store_id',
        'order_id',
        'delivery_number',
        'delivery_company',
        'delivery_type',
        'coupon',
        'amount',
        'status',
        'barter_delivery_number',
        'barter_delivery_company',
        'barter_delivery_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Barter::class;
    }
}
