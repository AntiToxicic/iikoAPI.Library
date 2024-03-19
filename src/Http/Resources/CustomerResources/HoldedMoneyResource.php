<?php

namespace IikoApiLibrary\Http\Resources\CustomerResources;

use Illuminate\Http\Resources\Json\JsonResource;

class HoldedMoneyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'transactionId' => $this['transactionId'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
