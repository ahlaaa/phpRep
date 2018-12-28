<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Address",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="province",
 *          description="省",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="city",
 *          description="市",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="county",
 *          description="县",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="street",
 *          description="街道",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="用户_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *     @SWG\Property(
 *          property="telephone",
 *          description="联系电话",
 *          type="integer",
 *          format="string"
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
class Address extends Model
{
    use SoftDeletes;

    public $table = 'addresses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'province',
        'city',
        'county',
        'street',
        'user_id',
        'telephone',
        'consignee',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'province' => 'string',
        'city' => 'string',
        'county' => 'string',
        'street' => 'string',
        'telephone' => 'string',
        'consignee' => 'string',
        'user_id' => 'integer',
        'updated_user_id' => 'integer',
        'updated_user_name' => 'string',
        'created_user_id' => 'integer',
        'created_user_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'province' => 'required',
        'city' => 'required',
        'county' => 'required',
        'street' => 'required',
        'consignee' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getLocationAttribute()
    {
        return $this->getAttribute('province') . $this->getAttribute('city') . $this->getAttribute('county') . $this->getAttribute('street');
    }

    public function getFullInfoAttribute()
    {
        return
            //$this->user->name .
            '-' .
            $this->getAttribute('province') .
            $this->getAttribute('city') .
            $this->getAttribute('county') .
            $this->getAttribute('street') .
            '(' .
            $this->getAttribute('telephone') . ')';
    }
}
