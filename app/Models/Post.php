<?php

namespace App\Models;

use App\Filter\Filters\PostFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
       'api_published_at',
    ];

    public static $roles = [
      'title' =>'required' ,
      'body'  =>'required'
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

    public function scopeLastPost($query){
      return  $query->orderBy('id','desc');
    }

    public function scopeFilter(Builder $builder,Request $request,$otherFilters =[]){
         return (new PostFilters($request))->add($otherFilters)->filter($builder);
    }

}
