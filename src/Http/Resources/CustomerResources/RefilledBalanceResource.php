<?php

namespace IikoApiLibrary\Http\Resources\CustomerResources;

use Illuminate\Http\Resources\Json\JsonResource;

class RefilledBalanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
