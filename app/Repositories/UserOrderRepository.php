<?php

namespace App\Repositories;

use App\Models\UserOrder;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class UserOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'order_id',
        'leader_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserOrder::class;
    }
}
