<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/20
 * Time: 14:41
 */

namespace App\Models;


use App\Observers\MaintainObserve;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintain extends Model
{

    use SoftDeletes;

    public $table = 'maintains';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $appends = ['type_str','status_str'];

    public $fillable = [
        'id',
        'order_id',
        'type',
        'o_amount',
        're_amount',
        'reason',
        'comments',
        'status',
        'number',
        'replay_text',
        'order_status',
        'user_id',
        'product_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'type' => 'integer',
        'o_amount' => 'float',
        're_amount' => 'float',
        'reason' => 'string',
        'comments' => 'string',
        'status' => 'integer',
        'number' => 'string',
        'replay_text' => 'string',
        'order_status' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer',
    ];

    public static $rules = [
      'order_status' => 'required',
      'user_id' => 'required',
      'order_id' => 'required',
    ];

    public function getTypeStrAttribute(){
        $status = array_get(constants('MAINTAIN_TYPE'),$this->type);
        return is_array($status)?'':$status;
    }
    public function getStatusStrAttribute(){
        $status = array_get(constants('MAINTAIN_STATUS'),$this->status);
        return is_array($status)?'':$status;
    }
    public static function boot()
    {
        parent::boot();
        static::observe(new MaintainObserve());
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function cates(){
        return $this->belongsToMany(Cate::class)->with('product')->withPivot(['qty','remark'])->withTrashed()->withTimestamps();;
    }
}