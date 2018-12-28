<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="SystemConfig",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="img_slide",
 *          description="img_slide",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="img_ad",
 *          description="img_ad",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="introduce",
 *          description="introduce",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_synopsis",
 *          description="enterprise_synopsis",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_situation",
 *          description="enterprise_situation",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_growth",
 *          description="enterprise_growth",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_coalition",
 *          description="enterprise_coalition",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_address",
 *          description="enterprise_address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_telephone",
 *          description="enterprise_telephone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="enterprise_email",
 *          description="enterprise_email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="qrcode1",
 *          description="qrcode1",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="qrcode2",
 *          description="qrcode2",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="updated_user_id",
 *          description="updated_user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="updated_user_name",
 *          description="updated_user_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_user_id",
 *          description="created_user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_user_name",
 *          description="created_user_name",
 *          type="string"
 *      )
 * )
 */
class SystemConfig extends Model
{
    use SoftDeletes;

    public $table = 'system_configs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'img_slide',
        'img_ad',
        'introduce',
        'enterprise_synopsis',
        'enterprise_situation',
        'enterprise_growth',
        'enterprise_coalition',
        'enterprise_address',
        'enterprise_telephone',
        'enterprise_email',
        'qrcode1',
        'qrcode2',
        'updated_user_id',
        'updated_user_name',
        'created_user_id',
        'created_user_name',
        'pro_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'img_slide' => 'string',
        'img_ad' => 'string',
        'introduce' => 'string',
        'enterprise_synopsis' => 'string',
        'enterprise_situation' => 'string',
        'enterprise_growth' => 'string',
        'enterprise_coalition' => 'string',
        'enterprise_address' => 'string',
        'enterprise_telephone' => 'string',
        'enterprise_email' => 'string',
        'qrcode1' => 'string',
        'qrcode2' => 'string',
        'updated_user_id' => 'integer',
        'updated_user_name' => 'string',
        'created_user_id' => 'integer',
        'created_user_name' => 'string',
        'pro_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
