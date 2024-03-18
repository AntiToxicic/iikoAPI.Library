<?php

namespace IikoApiLibrary\Http\Resources\CustomerResources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddedCustomerToProgramResource extends JsonResource
{
    public function toArray($request)
    {
        return [
           'userWalletId' => $this['userWalletId'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
