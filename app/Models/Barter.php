<?php

namespace App\Models;

use App\Traits\UserTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Barter",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="number",
 *          description="number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address_id",
 *          description="address_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_name",
 *          description="user_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="store_id",
 *          description="store_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="order_id",
 *          description="order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="delivery_number",
 *          description="delivery_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="delivery_company",
 *          description="delivery_company",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="delivery_type",
 *          description="delivery_type",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="coupon",
 *          description="coupon",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="barter_delivery_number",
 *          description="barter_delivery_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="barter_delivery_company",
 *          description="barter_delivery_company",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="barter_delivery_type",
 *          description="barter_delivery_type",
 *          type="boolean"
 *      )
 * )
 */
class Barter extends Model
{
    use SoftDeletes, UserTrait;

    public $table = 'barters';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'number',
        'address_id',
        'user_name',
        'user_id',
        'store_id',
        'order_id',
        'delivery_number',
        'delivery_company',
        'delivery_type',
        'coupon',
        'amount',
        'status',
        'barter_delivery_number',
        'barter_delivery_company',
        'barter_delivery_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'number' => 'string',
        'address_id' => 'integer',
        'user_name' => 'string',
        'user_id' => 'integer',
        'store_id' => 'integer',
        'order_id' => 'integer',
        'delivery_number' => 'string',
        'delivery_company' => 'string',
        'delivery_type' => 'integer',
        'status' => 'integer',
        'barter_delivery_number' => 'string',
        'barter_delivery_company' => 'string',
        'barter_delivery_type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
