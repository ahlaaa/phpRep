<?php

namespace App\Repositories;

use App\Models\Article;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
*/
class ArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'status',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Article::class;
    }
}
