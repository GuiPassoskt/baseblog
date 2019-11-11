<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    // use SoftDeletes;
    
    protected $table = 'product_categories';

    protected $fillable = ['name',  'image'];

    protected $appends = ['url_image'];

    public function getUrlImageAttribute()
    {

        if (! isset($this->attributes['image'])) return;
        
        return url(\Storage::url($this->attributes['image']));
    }
}
