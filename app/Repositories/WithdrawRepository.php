<?php

namespace App\Repositories;

use App\Models\Withdraw;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WithdrawRepository
 * @package App\Repositories
 * @version July 25, 2018, 9:32 am CST
 *
 * @method Withdraw findWithoutFail($id, $columns = ['*'])
 * @method Withdraw find($id, $columns = ['*'])
 * @method Withdraw first($columns = ['*'])
*/
class WithdrawRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'user_id',
        'remark',
        'status',
        'user_name',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Withdraw::class;
    }
}
