<?php

namespace App\Models;

use App\Traits\StatusTrait;
use App\Traits\UserTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Store",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="telephone",
 *          description="telephone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      )
 * )
 */
class Store extends Model
{
    use SoftDeletes, UserTrait, StatusTrait;

    public $table = 'stores';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['status_str'];

    public $fillable = [
        'user_id',
        'telephone',
        'name',
        'address',
        'province',
        'city',
        'county',
        'status',
        'balance',
        'lng',
        'lat',
        'img_avatar',
        'img_introduce',
        'introduce',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status' => 'integer',
        'telephone' => 'string',
        'province' => 'string',
        'city' => 'string',
        'county' => 'string',
        'name' => 'string',
        'address' => 'string',
        'balance' => 'float',
        'lng' => 'float',
        'lat' => 'float',
        'img_avatar' => 'string',
        'img_introduce' => 'string',
        'introduce' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
