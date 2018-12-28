<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 15:02
 */

namespace App\Repositories;


use App\Models\Maintain;

class MaintainRepository extends BaseRepository
{


    protected $fieldSearchable = [
        'number',
        'order_id',
        'type',
        'status',
        'order_status',
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Maintain::class;
    }
}