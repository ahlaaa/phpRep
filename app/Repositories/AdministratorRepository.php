<?php

namespace App\Repositories;

use App\Models\Administrator;

/**
 * Class AdministratorRepository
 * @package App\Repositories
 * @version July 14, 2018, 10:37 am CST
 *
 * @method Administrator findWithoutFail($id, $columns = ['*'])
 * @method Administrator find($id, $columns = ['*'])
 * @method Administrator first($columns = ['*'])
*/
class AdministratorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'type',
        'password'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Administrator::class;
    }
}
