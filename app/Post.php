<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;


    /**
     * Generates the Urls for Model Access
     * and Manipulation
     *
     * @return array
     **/
    public function getUrlAttribute()
    {
        $urls = [
            'editAction' => route('posts.edit',$this),
            'deleteAction' => route('posts.destroy',$this),
            'showAction' => route('posts.show',$this),
        ];

        return $urls;
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];
}
