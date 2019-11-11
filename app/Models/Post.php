<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'posted_at', 'excerpt', 'meta_keywords', 'slug', 'cover_image'];

    protected $dates = ['posted_at'];

    protected $appends = ['url_cover_image', 'url'];


    public function getUrlCoverImageAttribute()
    {

        if (! isset($this->attributes['cover_image'])) return;
        
        return url(\Storage::url($this->attributes['cover_image']));
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUrlAttribute()
    {
        return url('blog', $this->slug);
    }
}
