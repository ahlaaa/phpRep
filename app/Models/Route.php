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
class Route extends Model
{
    use SoftDeletes;

    public $table = 'routes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = [];

    public $fillable = [
        'id',
        'name',
        'remark',
        'images',
        'content',
        'price',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'remark' => 'string',
        'images' => 'string',
        'content' => 'string',
        'price' => 'float',
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

    public function parameters()
    {
        return $this->belongsToMany(Parameter::class)->withPivot(["remark","images","name"])->withTimestamps();
    }
}
