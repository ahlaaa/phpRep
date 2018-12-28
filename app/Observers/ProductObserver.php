<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/7
 * Time: 9:03
 */

namespace App\Observers;

use App\Models\Cate;
use App\Models\Product;
use App\Models\Standard;
use Illuminate\Notifications\Notifiable;
use Auth;
use Log;

class ProductObserver
{
    use  Notifiable;

    public function creating(Product $model)
    {
//        Log::info(request()->get('standard'));

    }
    public function created(Product $model){
        Log::info('is_cate::'.request()->get('is_cate'));
        if (!empty(request()->get('is_cate',null))) {
            $this->create_cate($model);
        }
    }
    private function create_cate(Product $model){

            $list = array();
            if(!empty(request()->get('standard',null))) {
                foreach (request()->get('standard') as $k => $v) {
                    $list[sizeof($list)] = new Standard(['name' => $v['name'], 'father_name' => $v['father_name'] ?? null, 'sequence' => $v['sequence'] ?? 0]);
                }
                $model->standards()->saveMany($list);
            }
            unset($list);
            $list = array();
            if(!empty(request()->get('cate',null))) {
                foreach (request()->get('cate') as $k => $v) {
                    $list[sizeof($list)] =
                        new Cate(['name' => $v['name'], 'qty' => $v['qty'] ?? 0, 'pre_price' => $v['pre_price'] ?? 0.00, 'price' => $v['price'] ?? 0.00,
                            'old_price' => $v['old_price'] ?? 0.00, 'base_price' => $v['base_price'] ?? 0.00, 'code' => $v['code'] ?? null,
                            'bar_code' => $v['bar_code'] ?? null, 'weight' => $v['weight'] ?? 0.00]);
                }
                $model->cates()->saveMany($list);
            }
    }

    public function updating(Product $model)
    {
//        Log::info(request()->all());
//        if (!empty(request()->get('change_cate',null))) {
//            $this->change_cate($model);
//        }
    }
    public function updated(Product $model)
    {
//        Log::info(request()->all());
//        if (!empty(request()->get('change_cate',null))) {
//            $this->change_cate($model);
//        }
    }
    private function change_cate(Product $model){

            $model->standards()->delete();
            $list = array();
            Log::info('standard');
            Log::info(request()->get('standard'));
            if (!empty(request()->get('standard', null))){
                foreach (request()->get('standard') as $k => $v) {
                    $list[sizeof($list)] = new Standard(['name' => $v['name'], 'father_name' => $v['father_name'] ?? null, 'sequence' => $v['sequence'] ?? 0]);
                }
                $model->standards()->saveMany($list);
            }
            unset($list);
            $model->cates()->delete();
            $list = array();
            Log::info('cate');
            Log::info(request()->get('cate'));
            if (!empty(request()->get('cate', null))) {
                foreach (request()->get('cate') as $k => $v) {
                    $list[sizeof($list)] =
                        new Cate(['name' => $v['name'], 'qty' => $v['qty'] ?? 0, 'pre_price' => $v['pre_price'] ?? 0.00, 'price' => $v['price'] ?? 0.00,
                            'old_price' => $v['old_price'] ?? 0.00, 'base_price' => $v['base_price'] ?? 0.00, 'code' => $v['code'] ?? null,
                            'bar_code' => $v['bar_code'] ?? null, 'weight' => $v['weight'] ?? 0.00]);
                }
                $model->cates()->saveMany($list);
            }
    }

    public function deleted(Product $model)
    {
        $model->cates()->delete();
        $model->standards()->delete();
    }

}