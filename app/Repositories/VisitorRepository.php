<?php

namespace App\Repositories;

use App\Models\Visitor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class VisitorRepository
 * @package App\Repositories
 * @version July 27, 2018, 9:15 am CST
 *
 * @method Visitor findWithoutFail($id, $columns = ['*'])
 * @method Visitor find($id, $columns = ['*'])
 * @method Visitor first($columns = ['*'])
*/
class VisitorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nickname',
        'img_avatar',
        'openid'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Visitor::class;
    }
}
