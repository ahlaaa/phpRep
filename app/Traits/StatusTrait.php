<?php

namespace App\Traits;


trait StatusTrait
{
    public function getStatusStrAttribute()
    {
        return array_get(constants(class_basename(static::class) . '_STATUS'), $this->getAttribute('status'));
    }
}