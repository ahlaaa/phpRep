<?php

namespace App\Repositories;

use App\Models\Brand;

/**
 * Class BrandRepository
 * @package App\Repositories
 * @version March 10, 2018, 11:11 am CST
 *
 * @method Brand findWithoutFail($id, $columns = ['*'])
 * @method Brand find($id, $columns = ['*'])
 * @method Brand first($columns = ['*'])
*/
class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'status',
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
        return Brand::class;
    }
}
