<?php

namespace App\Repositories;

use App\Models\Grade;

/**
 * Class GradeRepository
 * @package App\Repositories
 * @version July 4, 2018, 10:02 am CST
 *
 * @method Grade findWithoutFail($id, $columns = ['*'])
 * @method Grade find($id, $columns = ['*'])
 * @method Grade first($columns = ['*'])
*/
class GradeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'name',
        'level'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Grade::class;
    }

    public function agent()
    {
        return $this->findByField('type', 1);
    }

    public function customer()
    {
        return $this->findByField('type', 2);
    }

    public function type(int $type)
    {
        return $this->findByField('type', $type)->pluck('name', 'id');
    }
}
