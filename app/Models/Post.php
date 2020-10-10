<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => false,
            ]
        ];
    }

    protected $table = 'posts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'desc',
        'content',
        'image',
        'views',
        'status',
        'is_highlight_index',
        'is_focus_index'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getTagListAttribute()
    {
        return $this->tags()->pluck('name')->all();
    }

    public function scopePublish($query)
    {
        $query->where('status', true);
    }

    public function getRelatedPostsAttribute()
    {
        $limit = 5;
        $post_tag = $this->tags()->pluck('id')->all();

        $postIds = Post::where('status', true)
            ->whereHas('tags', function($q) use ($post_tag){
                $q->whereIn('id', $post_tag);
            })
            ->where('id', '!=', $this->id)
            ->orderBy('updated_at', 'desc')
            ->limit($limit)
            ->pluck('id')
            ->all();

        $additionPosts = null;

        if (count($postIds) < $limit) {
            $categoryLimit = $limit - count($postIds);
            $postIds +=Post::where('status', true)
                ->where('category_id', $this->category_id)
                ->where('id', '!=', $this->id)
                ->orderBy('updated_at', 'desc')
                ->limit($categoryLimit)
                ->pluck('id')
                ->all();
        }
        return Post::whereIn('id', $postIds)->get();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
