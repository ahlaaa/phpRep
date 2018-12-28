<?php

namespace App\Repositories;

use App\Models\Card;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
 */
class CardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'product_id',
        'name',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Card::class;
    }
}
