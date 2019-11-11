<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductContent extends Model
{
    protected $fillable = ['text', 'product_id', 'user_id', 'type'];

    protected $appends = ['formatted_text'];
    
    // public $timestamps = false;

    public function getFormattedTextAttribute()
    {
        if ($this->type === 'list') {
            return explode("\n", $this->attributes['text']);
        }

        return $this->attributes['text'];
    }
}
