<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

/**
 * @SWG\Definition(
 *      definition="Article",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="标题",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="content",
 *          description="内容",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="状态  0 => '隐藏',1 => '显示'",
 *          type="int8"
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
class Sapling extends Model
{
    use SoftDeletes, StatusTrait;

    public $table = 'saplings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $appends = ['status_str', 'type_str'];


    public $fillable = [
        'user_id',
        'product_id',
        'type',
        'status',
        'cate_id',
        'order_number',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'type' => 'integer',
        'status' => 'integer',
        'cate_id' => 'integer',
        'order_number' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getTypeStrAttribute()
    {
        return array_get(constants('PRODUCT_VE'), $this->type);
    }

    public function getStatusStrAttribute()
    {
        return array_get(constants('SAPLING_STATUS'), $this->status);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cate()
    {
        return $this->belongsTo(Cate::class)->withTrashed();
    }

}
