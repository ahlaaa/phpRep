<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Visitor",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nickname",
 *          description="nickname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="img_avatar",
 *          description="img_avatar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="openid",
 *          description="openid",
 *          type="string"
 *      )
 * )
 */
class Visitor extends Model
{
    use SoftDeletes;

    public $table = 'visitors';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nickname',
        'img_avatar',
        'openid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nickname' => 'string',
        'img_avatar' => 'string',
        'openid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
