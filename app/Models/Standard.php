<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Standard",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="product_id",
 *          description="product_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      )
 * )
 */
class Standard extends Model
{
    use SoftDeletes;

    public $table = 'standards';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'product_id',
        'name',
        'father_name',
        'sequence',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'name' => 'string',
        'father_name' => 'string',
        'sequence' => 'integer'
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
        return $this->belongsTo(Product::class)->withTrashed();//->withPivot('name')->withTrashed();//, 'column2');;
    }
    
}
