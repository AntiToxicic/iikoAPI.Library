<?php

namespace IikoApiLibrary\Http\Resources\CustomerResources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'] ?? null,
            'referrerId' => $this['referrerId'] ?? null,
            'name' => $this['name'] ?? null,
            'surname' => $this['surname'] ?? null,
            'middleName' => $this['middleName'] ?? null,
            'comment' => $this['comment'] ?? null,
            'phone' => $this['phone'] ?? null,
            'cultureName' => $this['cultureName'] ?? null,
            'birthday' => $this['birthday'] ?? null,
            'email' => $this['email'] ?? null,
            'sex' => $this['sex'] ?? null,
            'consentStatus' => $this['consentStatus'] ?? null,
            'anonymized' => $this['anonymized'] ?? null,
            'cards' => $this['cards'] ?? null,
            'categories' => $this['categories'] ?? null,
            'walletBalances' => $this['walletBalances'] ?? null,
            'userData' => $this['userData'] ?? null,
            'shouldReceivePromoActionsInfo' => $this['shouldReceivePromoActionsInfo'] ?? null,
            'shouldReceiveLoyaltyInfo' => $this['shouldReceiveLoyaltyInfo'] ?? null,
            'shouldReceiveOrderStatusInfo' => $this['shouldReceiveOrderStatusInfo'] ?? null,
            'personalDataConsentFrom' => $this['personalDataConsentFrom'] ?? null,
            'personalDataConsentTo' => $this['personalDataConsentTo'] ?? null,
            'personalDataProcessingFrom' => $this['personalDataProcessingFrom'] ?? null,
            'personalDataProcessingTo' => $this['personalDataProcessingTo'] ?? null,
            'isDeleted' => $this['isDeleted'] ?? null,

            'correlationId' => $this['correlationId'] ?? null
        ];
    }
}
