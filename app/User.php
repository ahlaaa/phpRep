<?php

namespace App;

use App\Models\Address;
use App\Models\Card;
use App\Models\Cert;
use App\Models\Medal;
use App\Models\Grade;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sapling;
use App\Models\Store;
use App\Models\Tourist;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Response;
use InfyOm\Generator\Utils\ResponseUtil;
use Illuminate\Auth\Middleware\Authenticate;
use League\OAuth2\Server\Exception\OAuthServerException;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 自定义用Passport授权登录：用户名+密码
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        $user = self::where('telephone', $username)->first();
        $tel_code = $_COOKIE['jmy_tel_code']??null;
        $tel_validate = request()->input('code',null);
        if (empty($user) || empty($tel_validate))
            return false;
        setcookie('jmy_tel_code',null,time(),'/');
        return $user;
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

    public function subordinates()
    {
        return $this->hasMany(\App\Models\User::class, 'superior_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class);
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 优惠券
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_user', 'user_id', 'card_id')
            ->withPivot(['price','product_num','product_unit','product_id','card_num'])->withTimestamps();
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 用户勋章
     */
    public function medals()
    {
        return $this->belongsToMany(Medal::class, 'medal_user', 'user_id', 'medal_id')
            ->wherePivot(['medal_num'])->withTimestamps();
    }

    public function certs()
    {
        return $this->belongsToMany(Cert::class, 'cert_user', 'user_id', 'cert_id')
            ->withPivot(['begin_at','end_at'])->withTimestamps();
    }

}
