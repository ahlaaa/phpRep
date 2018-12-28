<?php

namespace App\Repositories;

use App\Models\Log;

/**
 * Class WithdrawRepository
 * @package App\Repositories
 * @version July 25, 2018, 9:32 am CST
 *
 * @method Withdraw findWithoutFail($id, $columns = ['*'])
 * @method Withdraw find($id, $columns = ['*'])
 * @method Withdraw first($columns = ['*'])
*/
class LogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'txt',
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
        return Log::class;
    }
}
