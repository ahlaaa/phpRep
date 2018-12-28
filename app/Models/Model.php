<?php

namespace App\Models;

use Eloquent as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class Model extends BaseModel
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

}
