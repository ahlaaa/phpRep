<?php

namespace App\Models;

use App\Observers\ExchangelogObserver;
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
class Exchangelog extends Model
{
    use SoftDeletes;

    public $table = 'exchangelogs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['status_str'];

    public $fillable = [
        'id',
        'user_id',
        'medal_ids',
        'card_id',
        'card_name',
        'status',
//        'delivery_number',
//        'delivery_company',
//        'delivery_company',
//        'deal_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id'  => 'integer',
        'medal_ids'  => 'string',
        'card_id'  => 'integer',
        'card_name'  => 'string',
        'status' => 'string',
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

        static::observe(new ExchangelogObserver());
    }

    public function getStatusStrAttribute()
    {
        return array_get(constants('EXC_STATUS'), $this->status ?? 1);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
