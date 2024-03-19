<?php

namespace IikoApiLibrary\Http\Resources\MenuResources;

use Illuminate\Http\Resources\Json\JsonResource;

class CombosInfoResource extends JsonResource
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
            'comboSpecifications' => $this['comboSpecifications'] ?? null,
            'comboCategories' => $this['comboCategories'] ?? null,
            'Warnings' => $this['Warnings'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
