<?php

namespace App\Models;

use App\Observers\UserObserver;
use App\Traits\StatusTrait;
use App\Traits\TypeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="姓名",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="username",
 *          description="用户名",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="wechat",
 *          description="微信号",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="telephone",
 *          description="电话",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="coupon",
 *          description="复购券金额",
 *          type="float"
 *      ),
 *      @SWG\Property(
 *          property="birthday",
 *          description="生日",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="open_id",
 *          description="open_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="状态",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="类型",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="grade",
 *          description="等级",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="superior_id",
 *          description="上级id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="img_head",
 *          description="头像",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="remember_token",
 *          description="remember_token",
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
class User extends Model
{
    use SoftDeletes, StatusTrait, TypeTrait;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at', 'password'];

    protected $appends = ['status_str'];

    public $fillable = [
        'name',
        'coupon',
        'password',
        'username',
        'wechat',
        'telephone',
        'email',
        'birthday',
        'open_id',
        'status',
        'type',
        'type',
        'grades_id',
        'superior_id',
        'img_head',
        'province',
        'city',
        'county',
        'point',
        'rebate',
        'qrcode',
        'tags',
        'truename',
        'tag_id',
        'is_static_desc',
        'tour_times',
        'card_times',
        'apply_free',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'username' => 'string',
        'wechat' => 'string',
        'telephone' => 'string',
        'email' => 'string',
        'birthday' => 'date:Y-m-d',
        'open_id' => 'string',
        'status' => 'integer',
        'coupon' => 'float',
        'rebate' => 'float',
        'point' => 'float',
        'type' => 'integer',
        'grades_id' => 'integer',
        'subordinate_limit' => 'integer',
        'superior_id' => 'integer',
        'img_head' => 'string',
        'province' => 'string',
        'city' => 'string',
        'county' => 'string',
        'qrcode' => 'string',
        'tags' => 'string',
        'truename' => 'string',
        'tag_id' => 'integer',
        'is_static_desc' => 'integer',
        'tour_times' => 'integer',
        'card_times' => 'integer',
        'apply_free' => 'integer',
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

        static::observe(new UserObserver());
    }

    public function nexlevel(){
        $level = $this->grade->level;
        return Grade::where([['type',1],['level','>',$level],['status',1]])->orderBy('level','desc')->first();
    }

    public function superior()
    {
        return $this->belongsTo(static::class, 'superior_id')->withDefault(function () {
            return static::find(1);
        });
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class,'grades_id');
    }
    public function grades()
    {
        return $this->belongsToMany(Grade::class)->orderBy('created_at','asc')
            ->withPivot(['superior_id','type','is_oauthed','status','is_autoup','prox_name4','prox_name3','prox_name2','prox_level'])->withTimestamps();
    }

    public function gradesProx()
    {
        return $this->belongsToMany(Grade::class)->orderBy('created_at','asc')
            ->withPivot(['superior_id','type','is_oauthed','status','is_autoup','prox_name4','prox_name3','prox_name2','prox_level'])
            ->where([['grade_user.type',3],['grade_user.is_oauthed',1]])
            ->withTimestamps();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    // 树状树 tree view 用
    public function getTreeAttribute()
    {
        function tree(User $user) {
           // dd($user->subordinates->count() === 0);
            return [
                'text' => $user->name,
                'tags' => [$user->subordinates->count()],
                'self' => $user,
                'superior' => $user->superior,
                //'href' => route('users.edit', $user->id),
                'nodes' => $user->subordinates->count() === 0 ?  [] : $user->subordinates->map(function ($user) {
                    return tree($user);
                })->toArray()
            ];
        };
        return collect(tree($this));
    }

    public function getTeams($id,$list = array())
    {
        $u_list = $this->where("superior_id",$id)->get()->toArray();
        if(sizeof($u_list) <= 0){
            return $u_list;
        }
        foreach($u_list as $u){
            array_push($list,$u);
            $this->getTeams($u["id"],$list);
        }
        return $list;
    }

//    public function getSubordinatesAttribute(): ?Collection
//    {
//        return static::whereSuperiorId($this->id)->get();
//    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'superior_id');
    }

    public function rebates()
    {
        return $this->hasMany(Rebate::class);
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 已确认订单
     */
    public function orders()
    {
        return $this->hasMany(Order::class);//->where('status',4)->orderBy('deal_time','desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 查看旅游订单
     */
    public function ordersTour(){
        return $this->belongsToMany(Order::class,'user_order','user_id','order_id')
            ->withPivot(['amount','status','leader_id','end_at','first_oid'])->with(['routes','users','inorder'])->withTimestamps();
    }
    public function tourists(){
        return $this->belongsToMany(Tourist::class,'user_order','user_id','first_oid')
            ->withPivot(['amount','status','leader_id','end_at','first_oid'])->with(['route','users','user'])->withTimestamps();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 所有订单
     */
    public function orders_all()
    {
        return $this->hasMany(Order::class)->orderBy('deal_time', 'desc');
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 优惠券
     */
//    public function cards1()
//    {
//        return $this->belongsToMany(Card::class, 'card_user', 'card_id', 'user_id')->withTimestamps();
//    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_user', 'user_id', 'card_id')
            ->withPivot(['price','product_num','product_unit','product_id','card_num'])->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 用户证书
     */
    public function certs()
    {
        return $this->belongsToMany(Cert::class, 'cert_user', 'user_id', 'cert_id')
            ->withPivot(['begin_at','end_at'])->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 用户勋章
     */
    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'medal_user', 'user_id', 'medal_id')
            ->wherePivot(['medal_num'])->withTimestamps();
    }

    public function saplings()
    {
        return $this->hasMany(Sapling::class);
    }
    public function saplingsSmall()
    {
        return $this->hasMany(Sapling::class)->where('saplings.type',6);
    }
    /**
     * @param User $user
     * @param int $num
     * 增加券
     */
    public function addCard(User $user,int $cid,int $num){
        $card = \DB::table('card_user')->where([['user_id',$user->id],['card_id',$cid]])->first();
        $card1 = Card::find($cid);
        /**
         * +2 消费券/50
         */
        if (!empty($card)){
            $data = array('price'=>$card1->price??0,'product_num'=>$card1->product_num??0,'product_unit'=>$card1->product_unit??null,
                'product_id'=>$card1->product_id??null);
            $data['card_num'] = ($card->card_num+$num);
            \DB::table('card_user')->where('id',$card->id)->update($data);
        }else{
            $data = array('user_id'=>$user->id,'card_id'=>1,'price'=>$card1->price??0,'product_num'=>$card1->product_num??0,'product_unit'=>$card1->product_unit??null,
                'product_id'=>$card1->product_id??null,'card_num'=>$num);
            \DB::table('card_user')->insert($data);
        }
    }
}
