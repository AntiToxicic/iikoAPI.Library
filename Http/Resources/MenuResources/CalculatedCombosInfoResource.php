<?php

namespace IikoApiLibrary\Http\Resources\MenuResources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalculatedCombosInfoResource extends JsonResource
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
            'price' => $this['price'] ?? null,
            'incorrectlyFilledGroups' => $this['incorrectlyFilledGroups'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
