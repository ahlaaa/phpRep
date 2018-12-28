<?php

namespace App\Models;

use App\Observers\OrderObserver;
use App\Traits\StatusTrait;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @SWG\Definition(
 *      definition="Order",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="金额",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="qty",
 *          description="数量",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="状态",
 *          type="int32"
 *      ),
 *      @SWG\Property(
 *          property="delivery_number",
 *          description="快递单号",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="delivery_company",
 *          description="快递公司",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="address_id",
 *          description="配送地址id",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="is_packing",
 *          description="是否打包",
 *          type="boolean"
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
class Order extends Model
{
    use SoftDeletes, StatusTrait, UserTrait;

    public $table = 'orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $appends = ['status_str', 'type_str', 'delivery_str', 'otype_str'];

    public $fillable = [
        'status',
        'user_id',
        'address_str',
        'address_id',
        'store_id',
        'number',
        'amount',
        'coupon',
        'user_name',
        'delivery_number',
        'delivery_company',
        'delivery_type',
        'product_id',
        'remark',
        'qty',
        'deal_time',
        'type',
        'vip_sales',
        'vip_card_sales',
        'send_fee',
        'pre_amount',
        'otype',
        'coupon_reduce',
        'card_id',
        'card_num',
        'leader_id',
        'father_id',
        'begin_at',
        'end_at',
        'min_users',
        'route_images',
        'touring_name',
        'use_times',
        'fruit_order',
        'use_chance',
        'route_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
        'user_id' => 'integer',
        'amount'=> 'float',
        'coupon'=> 'float',
        'address_str' => 'string',
        'address_id' => 'integer',
        'store_id' => 'integer',
        'user_name' => 'string',
        'delivery_company' => 'string',
        'delivery_number' => 'string',
        'delivery_type'=> 'integer',
        'product_id' => 'integer',
        'remark' => 'string',
        'qty' => 'integer',
        'type' => 'integer',
        'otype' => 'integer',
        'deal_time' => 'string',
        'vip_sales' => 'float',
        'vip_card_sales' => 'float',
        'send_fee' => 'float',
        'pre_amount' => 'float',
        'coupon_reduce' => 'float',
        'card_id' => 'integer',
        'card_num' => 'integer',
        'leader_id' => 'integer',
        'father_id' => 'integer',
        'begin_at' => 'date',
        'end_at' => 'date',
        'min_users' => 'integer',
        'route_images' => 'string',
        'touring_name' => 'string',
        'number' => 'string',
        'use_times' => 'integer',
        'fruit_order' => 'integer',
        'use_chance' => 'integer',
        "route_id" => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function getOtypeStrAttribute()
    {
        $status = array_get(constants('ORDER_OTYPE'), $this->otype);
        return is_array($status) ? '--' : $status;
    }
    public function getTypeStrAttribute(){
        $status = array_get(constants('ORDER_TYPE'),$this->type);
        return is_array($status)?'--':$status;
    }
    public function getDeliveryStrAttribute(){
        $status = array_get(constants('ORDER_DELIVERY_TYPE'),$this->delivery_type);
        return is_array($status)?'--':$status;
    }
    public static function boot()
    {
        parent::boot();

        static::observe(new OrderObserver());
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function card()
    {
        return $this->hasOne(Card::class);
    }
//    public function products()
//    {
//        return $this->belongsToMany(Product::class)->withPivot(['qty', 'remark'])->withTrashed();
//    }
//    public function goods()
//    {
//        return $this->belongsToMany(Goods::class)->withPivot(['qty', 'remark'])->withTrashed()->withTimestamps();
//    }
    public function cates()
    {
        return $this->belongsToMany(Cate::class)->with('product')
            ->withPivot(['qty','remark','price','iprice'])->withTrashed()->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_order','first_oid','user_id')
            ->withPivot(['amount','status','leader_id','end_at','first_oid'])->withTimestamps();
    }

    public function inorder(){
        return $this->belongsTo(Order::class,'father_id')->with(['routes','users']);
    }

//    public function routes(){
//        return $this->belongsToMany(Parameter::class,'route_order','order_id','parameter_id')
//            ->withPivot(['name','remark','images','father_id'])->withTrashed()->withTimestamps();
//    }
    public function routes(){
        return $this->belongsTo(Route::class)->withTrashed();
    }
//    public function inroute(){
//        return $this->belongsToMany(Parameter::class,'route_order','parameter_id','father_id')
//            ->withPivot(['name','remark','images','father_id'])->withTrashed()->withTimestamps();
//    }
//    public function store()
//    {
//        return $this->belongsTo(Store::class)->withDefault(function() {
//            return Store::find(1);
//        });
//    }

    static function assUsers(Order $model){
//        \Log::info('ORDER::'.json_encode($model));
        if ($model->otype == 3) {
            $leader = Order::find($model->father_id);
            if (isset($leader)){
                $data = array('user_id'=>$model->user_id,'order_id'=>$model->id,'first_oid'=>$leader->id,'amount'=>$model->pre_amount,
                    'leader_id'=>$model->leader_id,'created_at'=>date('Y-m-d H:i:s'),'status'=>1);
            }else{
                $data = array('user_id'=>$model->user_id,'order_id'=>$model->id,'first_oid'=>$model->id,'amount'=>$model->pre_amount,
                    'leader_id'=>$model->user_id,'created_at'=>date('Y-m-d H:i:s'),'status'=>1);
            }
//            \Log::info('DATA::'.json_encode($data));
            $flag = UserOrder::insert($data);
//            \Log::info('FLAG::'.json_encode($flag));
//            \DB::table('route_order')->where('order_id',$model->id)->update(array('father_id'=>$model->id,'updated_at'=>date('Y-m-d H:i:s')));
        }
    }

    static function checkProx(Array $input):int {
        $province = array_get($input,'province');
        $city = array_get($input,'city');
        $country = array_get($input,'country');
        $data = array();
        $arr = array();
        if (!empty($province)) {
            $arr['prox_name4'] = $province;
            $data['province'] = $province;
        }
        if (!empty($city)) {
            $arr['prox_name3'] = $city;
            $data['city'] = $city;
        }
        if (!empty($country)) {
            $arr['prox_name2'] = $country;
            $data['country'] = $country;
        }
//        if (!empty($province))
//            $data['province'] = $province;
//        if (!empty($city))
//            $data['city'] = $city;
//        if (!empty($country))
//            $data['country'] = $country;
        $data['status'] = 2;
        $arr['status'] = 1;
        $users1 = \DB::table('grade_user')->where($arr)->get()->toArray();
        $users = Application::where($data)->get()->toArray();
        if (!empty(array_get($input,'use_chance')) && (sizeof($users1) == 0 && sizeof($users) == 0))
            return 1;
        if ((sizeof($users1) > 0 || sizeof($users) > 0 || array_get($input,'pre_amount') < 3999 || array_get($input,'level') != 2))
            return 0;
        return 1;
    }
    static function addApplication(Array $input,Order $model){
        $province = array_get($input,'province');
        $city = array_get($input,'city');
        $country = array_get($input,'country');
        $level = array_get($input,'level');
        $use_chance = array_get($input,'use_chance');
        $data = array('user_id'=>$model->user_id,'order_id'=>$model->id,'province'=>$province,'city'=>$city,'country'=>$country,'level'=>$level
        ,'created_at'=>date('Y-m-d H:i:s'));
        if (!empty($use_chance))
            $data['use_chance'] = $use_chance;
        Application::create($data);
    }
}
