<?php

namespace App\Repositories;

use App\Models\Vision;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:54 pm CST
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
*/
class VisionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uid',
        'e_mark',
        'p_mark',
        'a_mark',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Vision::class;
    }
}
