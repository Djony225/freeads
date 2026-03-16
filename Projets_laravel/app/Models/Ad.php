<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //
   protected $fillable = ['user_id', 'title', 'category_id', 'description', 'price', 'photo', 'location', 'status'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
