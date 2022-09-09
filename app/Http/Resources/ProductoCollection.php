<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductoCollection extends ResourceCollection
{
    public $collects = ProductResource::class;
 
    public function toArray($request)
    {
        //extiende de resource collection
        return [
            'data'=> $this->collection,
            'links'=>'metadata'
        ];
    }
}
