<?php

namespace IikoApiLibrary\Http\Resources\MenuResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExternalMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'] ?? null,
            'name' => $this['name'] ?? null,
            'description' => $this['description'] ?? null,
            'itemCategories' => $this['itemCategories'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
