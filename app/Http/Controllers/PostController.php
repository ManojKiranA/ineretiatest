<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\PaginatedLinks;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
                    ->select(['id','post_name','post_slug','post_description'])
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
                    ->paginate($paginationLength,['*'],'postPage')
                    ->appends($request->only(['postName','postDescription','perPageLength','globalSearch']))
                    ->onEachSide(2);

        $paginatedLinks = (new PaginatedLinks)->setPaginatorInstance($posts)->get();

        $viewShare = compact(['posts','paginatedLinks','postNameSearch','postDescriptionSearch','paginationLengthArray','paginationLength','globalSearchSearch']);


        return Inertia::render('Posts/Index',$viewShare);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        dd($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
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
