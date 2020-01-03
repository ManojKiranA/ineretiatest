<?php

namespace App\Http\Resources;

use App\Services\PaginatedLinks;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'paginatedLinks' => (new PaginatedLinks)->setPaginatorInstance($this->resource)->get(),
            
            'meta' => [
                'links' => [
                    "index" => route('posts.index'),
                    "create" => route('posts.create'),
                    "store" =>  route('posts.store'),
                ],
                'request' => [
                    'duration' => microtime(true) - LARAVEL_START,
                    'ipAddress' => $request->getClientIp(),
                ],
            ],
        ];   
    }
}
