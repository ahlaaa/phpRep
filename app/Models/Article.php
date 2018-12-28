<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Article",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="标题",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="content",
 *          description="内容",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="状态  0 => '隐藏',1 => '显示'",
 *          type="int8"
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
class Article extends Model
{
    use SoftDeletes, StatusTrait;

    public $table = 'articles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'category_id',
        'img_first',
        'content',
        'status',
        'is_top',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'category_id' => 'integer',
        'img_first' => 'string',
        'content' => 'string',
        'status' => 'integer',
        'is_top' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function category()
    {
        return $this->belongsto(ArticleCategory::class, 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('content');
    }

    public function getSimpleContentAttribute()
    {
        $content = $this->getAttribute('content');

        return str_limit($content, 20);
    }
}
