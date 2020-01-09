<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PaginatedLinks;
use App\User;
use Illuminate\Support\Facades\Auth;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // sleep(10);
        // dd(Auth::user()->toArray());
        $postNameSearch = $request->input('postName',null);

        $postDescriptionSearch = $request->input('postDescription',null);

        $globalSearchSearch = $request->input('globalSearch',null);

        $postObject = new Post;

        $paginationLength = (int) $request->input('perPageLength',$postObject->getPerPage());

        $paginationLengthArray = [
            5,
            10,
            20,
            30,
            50,
            100
        ];

        $posts = $postObject
                    ->select(['id','post_name','post_slug','post_description','user_id'])
                    // ->when($postNameSearch,function($query) use ($postNameSearch){
                    //         $query->where('post_name','LIKE','%'.$postNameSearch.'%');
                    // })
                    // ->when($postDescriptionSearch,function($query) use ($postDescriptionSearch){
                    //     $query->where('post_description','LIKE','%'.$postDescriptionSearch.'%');
                    // })
                    ->when($globalSearchSearch,function($query) use ($globalSearchSearch){
                        return $query->where('post_name','LIKE','%'.$globalSearchSearch.'%')
                            ->orWhere('post_description','LIKE','%'.$globalSearchSearch.'%')
                            ->orWhere('post_slug','LIKE','%'.$globalSearchSearch.'%')
                            ;
                    })
                    ->orderBy('id')
                    ->with(['user'])
                    ->paginate($paginationLength,['*'],'postPage')
                    ->appends($request->only(['postName','postDescription','perPageLength','globalSearch']))
                    ->onEachSide(2);
                    
        $cloner = clone $posts;
        $postResource = ((new PostResource($posts)));

        // dump($postResource);
        // return ($postResource);
        // dd(response($postResource)->getContent());

        $paginatedLinks = (new PaginatedLinks)->setPaginatorInstance($posts)->get();

        $viewShare = compact(['posts','paginatedLinks','postNameSearch','postDescriptionSearch','paginationLengthArray','paginationLength','globalSearchSearch','postResource']);


        return Inertia::render('Posts/Index',$viewShare);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usersList = User::query()
                        ->select(['id',DB::raw("CONCAT(name,' (',email, ')') AS nameEmail")])
                        ->pluck('nameEmail','id');

        $viewShare = compact(['usersList']);

        return Inertia::render('Posts/Create',$viewShare);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        
        $storeArray = array_merge(
            $request->only(['post_name','post_description','user_id']),
            [
                'post_slug' => Str::slug($request->get('post_name')),
            ]
        );
        Post::create($storeArray);

        return redirect()
                    ->route('posts.index')
                    ->with('success','Post Created Sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $updateArray = array_merge(
            $request->only(['post_name','post_description']),
            [
                'post_slug' => Str::slug($request->get('post_name')),
            ]
        );

        $post->update($updateArray);
            return redirect()
                    ->route('posts.index')
                    ->with('success','Post Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
                    ->back()
                    ->with('success','Post Deleted Sucessfully');
    }
}
