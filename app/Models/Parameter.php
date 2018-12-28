<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/16
 * Time: 9:33
 */

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;

class Parameter extends Model
{
    use SoftDeletes,StatusTrait;
    protected $table = 'parameters';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable =[
        'id',
        'name',
        'value',
        'product_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
      'id' => 'integer',
      'name' => 'string',
        'product_id' => 'integer',
        'value' => 'string',
    ];

    public function products(){
        return $this->belongsTo(Product::class);
    }
}