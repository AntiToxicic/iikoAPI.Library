<?php

namespace IikoApiLibrary\Http\Resources\DiscountPromotionResources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalculateCheckinResource extends JsonResource
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
            'loyaltyProgramResults' => $this->resource['loyaltyProgramResults'] ?? null,
            'availablePayments' => $this->resource['availablePayments'] ?? null,
            'Warnings' => $this->resource['Warnings'] ?? null,
            'loyaltyTrace' => $this->resource['loyaltyTrace'] ?? null,
        ];
    }
}
