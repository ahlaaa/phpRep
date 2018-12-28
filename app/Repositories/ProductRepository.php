<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version July 4, 2018, 11:05 am CST
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
*/
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'stock',
        'content',
        'status',
        'sort',
        'is_sellout',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
