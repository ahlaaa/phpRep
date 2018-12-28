<?php

namespace App\Models;

use App\Traits\TypeTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Grade",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="level",
 *          description="level",
 *          type="boolean"
 *      )
 * )
 */
class Grade extends Model
{
    use SoftDeletes, TypeTrait;

    public $table = 'grades';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['type_str'];

    public $fillable = [
        'type',
        'name',
        'level',
        'sales',
        'status',
        'amount',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
        'name' => 'string',
        'level' => 'integer',
        'sales' => 'float',
        'amount' => 'float',
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
}
