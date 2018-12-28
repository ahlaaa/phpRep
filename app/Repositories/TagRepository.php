<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/17
 * Time: 16:38
 */

namespace App\Repositories;


use App\Models\Tag;

class TagRepository extends BaseRepository
{

    protected $fieldSearchable = [

    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Tag::class;
    }
}