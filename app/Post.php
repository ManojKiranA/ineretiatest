<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

class Post extends Model
{
    /**
     * Scope a query to add all the Relations
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllRelations($query)
    {
        $reflextionClass = new \ReflectionClass(get_class($this));

        $relationClasses = [
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            \Illuminate\Database\Eloquent\Relations\BelongsToMany::class,
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            \Illuminate\Database\Eloquent\Relations\HasManyThrough::class,
            \Illuminate\Database\Eloquent\Relations\HasOne::class,
            \Illuminate\Database\Eloquent\Relations\HasOneOrMany::class,
            \Illuminate\Database\Eloquent\Relations\HasOneThrough::class,
        ];        

        $relationFunctions = [];

        foreach($reflextionClass->getMethods() as $eachMethod) 
        {
            if(in_array($eachMethod->getReturnType(),$relationClasses)):
                $relationFunctions[] = $eachMethod->getName();
            endif;
        }

        return $query->with($relationFunctions);
    }
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
                'index' => route('posts.index'),
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
    protected $fillable = ['post_name','post_slug','post_description','user_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
