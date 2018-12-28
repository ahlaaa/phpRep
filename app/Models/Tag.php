<?php
/**
 * Created by IntelliJ IDEA.
 * User: hl123
 * Date: 2018/11/17
 * Time: 16:28
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $table = 'tags';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
      'id',
      'name',
      'contents'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'contents' => 'string',
    ];

    public static $rules = [
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}