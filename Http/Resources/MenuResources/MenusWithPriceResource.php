<?php

namespace IikoApiLibrary\Http\Resources\MenuResources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenusWithPriceResource extends JsonResource
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
            'externalMenus' => $this['externalMenus'] ?? null,
            'priceCategories' => $this['priceCategories'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
