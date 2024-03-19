<?php

namespace IikoApiLibrary\iiko\api\Extensions;

use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\OrganizationResource;
use IikoApiLibrary\iiko\api\iikoClient;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

trait OrganizationExtension
{
    /**
     * Returns organizations available to api-login user.
     *
     * @param string[]|null $organizationIds
     * @param string[]|null $returnExternalData
     * @param bool $returnAdditionalInfo
     * @param bool $includeDisabled
     * @return OrganizationResource
     * @throws iikoHttpException
     */
    function GetOrganizationsInfo(array $organizationIds = null, array $returnExternalData = null,
                                  bool $returnAdditionalInfo = true, bool $includeDisabled = true): OrganizationResource
    {
        $methodName = 'api/1/organizations';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationIds'=> $organizationIds,
            'returnExternalData'=> $returnExternalData,
            'returnAdditionalInfo'=> $returnAdditionalInfo,
            'includeDisabled'=> $includeDisabled
        ];

        $response = Http::withoutVerifying()->withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new OrganizationResource($response);
    }

    /**
     * Returns available to api-login user organizations specified settings.
     *
     * @param string[] $parameters
     * @param string[]|null $organizationIds
     * @param bool $includeDisabled
     * @return OrganizationResource
     * @throws iikoHttpException
     */
    function GetOrganizationsInfoWithSettings(array $parameters, array $organizationIds = null,
                                              bool $includeDisabled = true): OrganizationResource
    {
        $methodName = 'api/1/organizations/settings';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            '$parameters'=> $parameters,
            'organizationIds'=> $organizationIds,
            'includeDisabled'=> $includeDisabled
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new OrganizationResource($response);
    }
}
