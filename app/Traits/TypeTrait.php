<?php

namespace App\Traits;


trait TypeTrait
{
    public function getTypeStrAttribute()
    {
        return array_get(constants(class_basename(static::class) . '_TYPE'), $this->getAttribute('type'));
    }
}