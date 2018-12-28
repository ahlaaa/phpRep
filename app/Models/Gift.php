<?php

namespace App\Models;

use App\Observers\CardObserver;
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
class Gift extends Model
{
    use SoftDeletes;

    public $table = 'gifts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = [];

    public $fillable = [
        'id',
        'user_id',
        'name',
        'fruit_nums',
        'fruit_end_time',
        'fruit_start_time',
        'order_id',
        'from_user_id',
        'type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'fruit_nums' => 'integer',
        'fruit_end_time' => 'date',
        'fruit_start_time' => 'date',
        'order_id' => 'integer',
        'from_user_id' => 'integer',
        'type' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

//    public static function boot()
//    {
//        parent::boot();
//
//        static::observe(new CardObserver());
//    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
