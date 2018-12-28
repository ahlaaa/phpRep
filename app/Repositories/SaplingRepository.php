<?php

namespace App\Repositories;

use App\Models\Sapling;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class SaplingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'product_id',
        'status',
        'type',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sapling::class;
    }
}
