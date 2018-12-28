<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/15
 * Time: 9:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cate extends Model
{
    use SoftDeletes;

    public $table = 'cates';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
      'id',
      'product_id',
      'qty',
      'pre_price',
      'price',
      'old_price',
      'base_price',
      'code',
      'bar_code',
      'weight',
        'name',
    ];
    public $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'qty' => 'integer',
        'pre_price' => 'float',
        'price' => 'float',
        'old_price' => 'float',
        'base_price' => 'float',
        'code' => 'string',
        'bar_code' => 'string',
        'weight' => 'float',
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}