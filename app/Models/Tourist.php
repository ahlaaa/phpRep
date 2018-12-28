<?php

namespace App\Models;

use App\Observers\TouristObserver;
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
class Tourist extends Model
{
    use SoftDeletes;

    public $table = 'tourists';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['status_str'];

    public $fillable = [
        'id',
        'name',
        'route_id',
        'remark',
        'user_id',
        'user_name',
        'begin_at',
        'end_at',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'route_id' => 'integer',
        'remark' => 'string',
        'user_id' => 'integer',
        'user_name' => 'string',
        'begin_at' => 'string',
        'end_at' => 'string',
        'status' => 'integer',
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

        static::observe(new TouristObserver());
    }

    public function getStatusStrAttribute()
    {
        return array_get(constants('TOURIST_STATUS'), $this->status ?? 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function users(){
        return $this->belongsToMany(User::class,'user_order','first_oid','user_id')
            ->withPivot(['id','amount','status','leader_id','end_at','first_oid','user_name'])->whereIn("user_order.status",[1,0])->withTimestamps();
    }
    public function route()
    {
        return $this->belongsTo(Route::class)->with("parameters")->withTrashed();
    }
}
