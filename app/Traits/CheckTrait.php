<?php

namespace App\Traits;


trait CheckTrait
{
    public function getCheckStrAttribute()
    {
        return array_get(constants(class_basename(static::class) . '_CHECK'), $this->getAttribute('check'));
    }
}