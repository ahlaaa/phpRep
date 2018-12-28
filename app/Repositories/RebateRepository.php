<?php

namespace App\Repositories;

use App\Models\Rebate;

/**
 * Class RebateRepository
 * @package App\Repositories
 * @version March 12, 2018, 2:28 pm CST
 *
 * @method Rebate findWithoutFail($id, $columns = ['*'])
 * @method Rebate find($id, $columns = ['*'])
 * @method Rebate first($columns = ['*'])
*/
class RebateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'amount',
        'user_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rebate::class;
    }
}
