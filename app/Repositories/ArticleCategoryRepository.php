<?php

namespace App\Repositories;

use App\Models\ArticleCategory;

/**
 * Class ArticleCategoryRepository
 * @package App\Repositories
 * @version March 10, 2018, 10:11 am CST
 *
 * @method ArticleCategory findWithoutFail($id, $columns = ['*'])
 * @method ArticleCategory find($id, $columns = ['*'])
 * @method ArticleCategory first($columns = ['*'])
*/
class ArticleCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'img',
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
        return ArticleCategory::class;
    }
}
