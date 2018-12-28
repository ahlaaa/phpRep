<?php

namespace App\Repositories;

use App\Models\Exchangelog;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class ExchangelogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'card_id',
        'card_name',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Exchangelog::class;
    }
}
