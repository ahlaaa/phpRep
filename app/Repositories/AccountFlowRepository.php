<?php

namespace App\Repositories;

use App\Models\AccountFlow;

/**
 * Class AccountFlowRepository
 * @package App\Repositories
 * @version March 19, 2018, 1:57 pm CST
 *
 * @method AccountFlow findWithoutFail($id, $columns = ['*'])
 * @method AccountFlow find($id, $columns = ['*'])
 * @method AccountFlow first($columns = ['*'])
*/
class AccountFlowRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'type',
        'amount',
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
        return AccountFlow::class;
    }
}
