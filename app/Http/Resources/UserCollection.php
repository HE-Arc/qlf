<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Purpose of resource collection:
 * resource collections translate a collection of models into an array.
 * 
 * This class is for now useless, since all resource provide a collection method 
 * to generate an "ad-hoc" resource collection, callable with : 
 *   UserResource::collection(...)
 * 
 * If we want to customize the data returned, this class is used then 
 * (check commented return in toArray method)
 */
class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /*
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
        */
    }
}
