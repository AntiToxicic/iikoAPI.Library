<?php

namespace IikoApiLibrary\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'organizations' => $this->resource['organizations'] ?? null,

            'correlationId' => $this->resource['correlationId'] ?? null
        ];
    }
}
