<?php

namespace App\Models;

use App\Observers\WithdrawObserver;
use App\Traits\StatusTrait;
use App\Traits\TypeTrait;
use App\Traits\UserTrait;
/**
 * @SWG\Definition(
 *      definition="Withdraw",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="remark",
 *          description="remark",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      )
 * )
 */
class Withdraw extends Model
{
    use UserTrait, StatusTrait, TypeTrait;

    public $table = 'withdraws';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['status_str', 'type_str'];


    public $fillable = [
        'amount',
        'user_id',
        'remark',
        'status',
        'type',
        'account',
        'username',
        'bank',
        'identification_card',
        'user_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'remark' => 'string',
        'status' => 'integer',
        'type' => 'integer',
        'account' => 'string',
        'username' => 'string',
        'bank' => 'string',
        'identification_card' => 'string',
        'user_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public static function boot()
    {
        parent::boot();

        static::observe(new WithdrawObserver());
    }

    
}
