<?php

namespace App\Repositories;

use App\Models\Gift;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class GiftRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'from_user_id',
        'type',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Gift::class;
    }
}
