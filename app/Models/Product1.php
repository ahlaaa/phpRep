<?php

namespace App\Models;

use App\Observers\ProductObserver;
use App\Traits\StatusTrait;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="img_main",
 *          description="img_main",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="img_design",
 *          description="img_design",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="region",
 *          description="region",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="stock",
 *          description="stock",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="content",
 *          description="content",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="sort",
 *          description="sort",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Product1 extends Model
{
    use StatusTrait;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'product_category_id',
        'name',
        'img_main',
        'img_design',
        'is_new',
        'is_hot',
        'price',
        'region',
        'stock',
        'content',
        'status',
        'superior1',
        'superior2',
        'superior3',
        'sort'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_category_id' => 'integer',
        'name' => 'string',
        'img_main' => 'string',
        'img_design' => 'string',
        'region' => 'string',
        'stock' => 'integer',
        'content' => 'string',
        'status' => 'integer',
        'superior1' => 'integer',
        'superior2' => 'integer',
        'superior3' => 'integer',
        'is_new' => 'integer',
        'is_hot' => 'integer',
        'sort' => 'integer'
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
        static::observe(new ProductObserver());
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)->where('type', 1)->withPivot('percentage');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function standards()
    {
        return $this->hasMany(Standard::class);
    }
}
