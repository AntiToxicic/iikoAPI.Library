<?php

namespace IikoApiLibrary\Http\Resources\DiscountPromotionResources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Programs' => $this->resource['Programs'] ?? null
        ];
    }
}
