<?php

namespace IikoApiLibrary\iiko\api\Extensions;

use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\OperationResource;
use IikoApiLibrary\iiko\api\iikoClient;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

trait OperationExtension
{
    /**
     * Use this method to get status of command
     *
     * @param string $organizationId
     * @param int $correlationId
     * @return OperationResource
     * @throws iikoHttpException
     */
    public function GetCommandStatus(string $organizationId, int $correlationId) : OperationResource
    {
        $methodName = 'api/1/commands/status';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'correlationId' => $correlationId
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new OperationResource($response);
    }
}
