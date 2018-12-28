<?php

namespace App\Models;

use App\Observers\MedalObserver;
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
class Medal extends Model
{
    use SoftDeletes;

    public $table = 'medals';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

//    protected $appends = ['type_str'];

    public $fillable = [
        'id',
        'name',
        'remark',
        'images',
        'prob_num',
//        'type',
//        'price',
//        'product_id',
//        'product_num',
//        'product_unit',
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
        'prob_num' => 'float',
//        'type' => 'integer',
//        'price' => 'float',
//        'product_id' => 'integer',
//        'product_num' => 'float',
//        'product_unit' => 'string',
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

        static::observe(new MedalObserver());
    }

//    public function getTypeStrAttribute()
//    {
//        return array_get(constants('CARD_TYPE'), $this->type ?? 2);
//    }

//    public function product()
//    {
//        return $this->belongsTo(Product::class);
//    }
}
