<?php

namespace App\Models;

use App\Traits\TypeTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Administrator",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="username",
 *          description="username",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      )
 * )
 */
class Administrator extends Authenticatable
{
    use SoftDeletes, TypeTrait;

    public $table = 'administrators';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['type_str'];

    public $fillable = [
        'username',
        'type',
        'password',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'type' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
