<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version January 22, 2018, 8:52 pm CST
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'username',
        'wechat',
        'telephone',
        'email',
        'birthday',
        'open_id',
        'status',
        'type',
        'grade',
        'superior_id',
        'img_head',
        'password',
        'remember_token',
        'updated_user_id',
        'updated_user_name',
        'created_user_id',
        'created_user_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function another($id)
    {
        $model = $this->model->where('id', '<>', $id)->pluck('name', 'id');

        $this->resetModel();

        return $this->parserResult($model);
    }

    public function customers()
    {
        return $this->findByField('type', 2)->pluck('name', 'id');
    }

    public function stores()
    {
        return $this->findWhere(['type'=>1, 'grade_id'=> 1])->pluck('name', 'id');
    }

    public function province(string $dist)
    {
        $ret = $this->findWhere(['type'=>1, 'grade_id'=> 4, 'province'=> $dist])->first();
        return  $ret ? $ret : value(function() {
            return User::find(1);
        });
    }

    public function city(string $dist)
    {
        $ret = $this->findWhere(['type'=>1, 'grade_id'=> 3, 'city'=> $dist])->first();

        return $ret ? $ret : value(function() {
            return User::find(1);
        });
    }

    public function county(string $dist)
    {
        $ret = $this->findWhere(['type'=>1, 'grade_id'=> 2, 'county'=> $dist])->first();

        return $ret ? $ret : value(function() {
            return User::find(1);
        });
    }
//    public function scopeFactory($query)
//    {
//        return $query->where('type', 0);
//    }
}
