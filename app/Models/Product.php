<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'user_id', 'description', 'product_category_id', 'url_web'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function image()
    {
        return $this->hasOne(ProductImage::class)->latest('id'); 
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }


    public function getUrlWebAttribute()
    {
        return route('page_product', [$this->id, str_slug($this->name)]);
    }
}
