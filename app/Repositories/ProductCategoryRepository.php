<?php

namespace App\Repositories;

use App\Models\ProductCategory;

/**
 * Class ProductCategoryRepository
 * @package App\Repositories
 * @version July 13, 2018, 5:33 pm CST
 *
 * @method ProductCategory findWithoutFail($id, $columns = ['*'])
 * @method ProductCategory find($id, $columns = ['*'])
 * @method ProductCategory first($columns = ['*'])
*/
class ProductCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'img',
        'is_top',
        'pid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductCategory::class;
    }
}
