<?php

namespace IikoApiLibrary\iiko\api;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\AuthorizationResource;
use IikoApiLibrary\iiko\api\Extensions\MenuExtension;
use IikoApiLibrary\iiko\api\Extensions\OrganizationExtension;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

class iikoClient
{
    use MenuExtension;
    use OrganizationExtension;

    protected string $baseUrl;
    public static $sessionToken;
    private $apiLogin;

    /**
     * @throws iikoHttpException
     */
    function __construct($apiLogin, $baseUrl)
    {
        $this->baseUrl = $baseUrl;

        $this->apiLogin = $apiLogin;

        $this::$sessionToken = Cache::get('session_token');

        if(!$this::$sessionToken || now() > Cache::get('session_token_expires'))
            $this->Authorize();
    }

    /**
     * @return iikoClient
     */
    function create() : self
    {
        return $this;
    }

    /**
     * Authorize user and save session token
     * @throws iikoHttpException
     */
    private function Authorize(): void
    {
        $methodName = 'api/1/access_token';

        $url = $this::baseUrl . "/" . $methodName;

         $requestData = [
            'apiLogin' => $this->apiLogin
        ];

        $response = Http::post($url,  $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        $dtoArray = new AuthorizationResource($response);

        $this::$sessionToken = $dtoArray['token'];

        $expressionTime = now()->addHour();
        Cache::put('session_token', $this::$sessionToken, $expressionTime);
    }
}

