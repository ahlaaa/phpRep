<?php

namespace App\Traits;


use App\Models\User;

trait UserTrait
{
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=> '已删除',
            'id'=> 1
        ]);
    }
}