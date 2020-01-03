<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

class Post extends Model
{
    use SoftDeletes;
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 5;


    /**
     * Generates the Urls for Model Access
     * and Manipulation
     *
     * @return array
     **/
    public function getLinksAttribute()
    {
        return [
                // 'index' => route('posts.index'),
                'currentroute' => (Route::currentRouteName()),
                'show' => route('posts.show',['post' => $this]),
                'edit' => route('posts.edit',['post' => $this]),
                'update' =>  route('posts.update',['post' => $this]),
                'delete' => route('posts.destroy',['post' => $this]),
        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['links'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_name','post_slug','post_description'];
}
