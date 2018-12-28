<?php

namespace App\Models;

use App\Observers\UserOrderObserver;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Log",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="txt",
 *          description="txt",
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
class UserOrder extends Model
{
    use SoftDeletes;

    public $table = 'user_order';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['status_str'];

    public $fillable = [
        'id',
        'user_id',
        'order_id',
        'amount',
        'status',
        'leader_id',
        'end_at',
        'first_oid',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'order_id' => 'integer',
        'amount' => 'float',
        'status' => 'integer',
        'leader_id' => 'integer',
        'end_at' => 'date',
        'first_oid' => 'integer',
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

        static::observe(new UserOrderObserver());
    }

    public function getStatusStrAttribute()
    {
        return array_get(constants('UO_STATUS'), $this->status ?? 0);
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->with(['users','routes']);
    }
    public function leader()
    {
        return $this->belongsTo(User::class,'leader_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function firstOrder()
    {
        return optional($this->belongsTo(Order::class,'first_oid'))->with(['users','routes']);
    }
}
