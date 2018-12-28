<?php

namespace App\Models;

use Eloquent as Model;
use App\Observers\ProductObserver;
use App\Traits\StatusTrait;
use App\Traits\CheckTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class Product extends Model
{
    use StatusTrait,SoftDeletes,CheckTrait;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $appends = ['typestr'];

    public $fillable = [
        'product_category_id',
        'volume',
        'name',
        'cname',
        'dname',
        'keysname',
        'type',
        'presell_on',
        'price',
        'oprice',
        'cprice',
        'sort',
        'sales',
        'fullpiece',
        'envelope',
        'freight',
        'support',
        'cash',
        'invoice',
        'status',
        'check',
        'is_show_main',
        'is_back',
        'confirm',
        'details',
        'code',
        'bar',
        'weig',
        'is_subtract',
        'is_showQty',
        'on_standards',
        'qty',
        'one_max',
        'one_min',
        'max',
        'grade_browse',
        'grade_buy',
        'img_main',
        'province',
        'city',
        'is_sellout',
        'in_distribute',
        'content',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_category_id' => 'integer',
        'volume' => 'integer',
        'name' => 'string',
        'cname' => 'string',
        'dname' => 'string',
        'keysname' => 'string',
        'type' => 'integer',
        'presell_on' => 'integer',
        'price' => 'float',
        'oprice' => 'float',
        'cprice' => 'float',
        'sort' => 'integer',
        'sales' => 'integer',
        'fullpiece' => 'integer',
        'envelope' => 'string',
        'freight' => 'string',
        'support' => 'boolean',
        'cash'=>'boolean',
        'invoice'=>'boolean',
        'status'=>'integer',
        'check' => 'integer',
        'is_show_main'=>'integer',
        'is_back'=>'integer',
        'confirm'=>'integer',
        'details' => 'integer',
        'code' => 'integer',
        'bar' => 'integer',
        'weig' => 'float',
        'is_subtract' => 'integer',
        'is_showQty' => 'integer',
        'on_standards' => 'integer',
        'qty' => 'integer',
        'one_max' => 'integer',
        'one_min' => 'integer',
        'max' => 'integer',
        'grade_browse' => 'integer',
        'grade_buy' => 'integer',
        'img_main' => 'string',
        'province' => 'string',
        'city' => 'string',
        'is_sellout' => 'boolean',
        'in_distribute' => 'integer',
        'content' => 'string',
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

    public function getTypestrAttribute()
    {
        return array_get(constants('PRODUCT_VE'),$this->type);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)->withPivot('percentage','price');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function standards()
    {
        return $this->hasMany(Standard::class);
    }
    public function cates()
    {
        return $this->hasMany(Cate::class);
    }
    public function parameters(){
        return $this->belongsToMany(Parameter::class)->withPivot('p_key','p_value');
    }

    public function distributes(){
        return $this->belongsToMany(Distribute::class)->withPivot(['type','perc_num','price_num','grade_id','distribute_type_num','in_use']);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 树苗领养情况
     */
    public function saplings()
    {
        return $this->hasMany(Sapling::class);
    }
//    public function parameters(){
//        return $this->hasMany(Parameter::class);//->withPivot('p_key','p_value');
//    }
}
