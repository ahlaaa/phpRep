<?php

namespace App\Repositories;

use App\Models\Application;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class ApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'order_id',
        'id',
        'level',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Application::class;
    }
}
