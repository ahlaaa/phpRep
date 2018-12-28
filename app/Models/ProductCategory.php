<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="ProductCategory",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="img",
 *          description="img",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_top",
 *          description="is_top",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="pid",
 *          description="pid",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class ProductCategory extends Model
{
    use SoftDeletes;

    public $table = 'product_categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['statusstr'];

    public $fillable = [
        'title',
        'img',
        'is_top',
        'pid',
        'status',
        'description',
        'sort',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'img' => 'string',
        'is_top' => 'integer',
        'pid' => 'integer',
        'status' => 'integer',
        'description' => 'string',
        'sort' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getStatusstrAttribute(){
        return array_get(constants('CATE_STATUS'),$this->status);
    }
    
}
