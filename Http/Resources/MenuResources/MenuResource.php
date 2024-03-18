<?php

namespace IikoApiLibrary\Http\Resources\MenuResources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)  : array
    {
        return [
            'groups' => $this['groups'] ?? null,
            'productCategories' => $this['productCategories'] ?? null,
            'products' => $this['products'] ?? null,
            'sizes' => $this['sizes'] ?? null,
            'revision' => $this['revision'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
