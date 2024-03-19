<?php

namespace IikoApiLibrary\Http\Resources\MenuResources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckedOutOfStockItemsResource extends JsonResource
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
            'rejectedItems' => $this['rejectedItems'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
