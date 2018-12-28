<?php

namespace App\Models;

use App\Observers\ApplicationObserver;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;

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
class Application extends Model
{
    use SoftDeletes;

    public $table = 'applications';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = [];

    public $fillable = [
        'id',
        'user_id',
        'order_id',
        'province',
        'city',
        'country',
        'level',
        'use_chance',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'order_id' => 'integer',
        'province' => 'string',
        'city' => 'string',
        'country' => 'string',
        'level' => 'integer',
        'use_chance' => 'integer',
        'status' => 'integer',
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

        static::observe(new ApplicationObserver());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    static function checkProx(Array $input):int{
        $province = array_get($input,'province');
        $city = array_get($input,'city');
        $country = array_get($input,'country');
        $data = array();
        $arr = array();
//        if (!empty($province))
//            $data['prox_name4'] = $province;
//        if (!empty($city))
//            $data['prox_name3'] = $city;
//        if (!empty($country))
//            $data['prox_name2'] = $country;
        if (!empty($province)) {
            $data['province'] = $province;
            $arr['prox_name4'] = $province;
        }
        if (!empty($city)) {
            $data['city'] = $city;
            $arr['prox_name3'] = $city;
        }
        if (!empty($country)) {
            $data['country'] = $country;
            $arr['prox_name2'] = $country;
        }
        $arr['status'] = 1;
        $data['status'] = 2;
        $users1 = \DB::table('grade_user')->where($arr)->get()->toArray();
        $users = Application::where($data)->get()->toArray();
        if (sizeof($users) > 0 || sizeof($users1) > 0)
            return 0;
        return 1;
    }
}
