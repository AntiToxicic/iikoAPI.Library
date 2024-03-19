<?php

namespace IikoApiLibrary\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorizationResource extends JsonResource
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
            'token' => $this->resource['token'] ?? null,

            'correlationId' => $this->resource['correlationId'] ?? null
        ];
    }
}
