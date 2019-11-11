<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'path'
    ];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return url(\Storage::url($this->attributes['path'], true));
    }


    public function getFullpathAttribute()
    {
        return \Storage::getAdapter()->applyPathPrefix('public/' . $this->path);
    }
}
