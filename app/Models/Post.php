<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property mixed title
 * @property mixed|string slug
 */
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
      'title',
       'slug',
       'body',
       'user_id',
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function (Post $post){
            $post->slug = Str::slug($post->title);
        });
    }

    public function getRouteKeyName()
    {
        return  'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
