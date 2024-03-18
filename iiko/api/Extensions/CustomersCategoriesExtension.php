<?php

namespace IikoApiLibrary\iiko\api\Extensions;

use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\CustomersCategoriesResources\AddedCategoriesResource;
use IikoApiLibrary\Http\Resources\CustomersCategoriesResources\CustomerCategoriesResource;
use IikoApiLibrary\Http\Resources\CustomersCategoriesResources\RemovedCategoriesResource;
use IikoApiLibrary\iiko\api\iikoClient;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

trait CustomersCategoriesExtension
{
    /**
     * Use this method to get all organization's customer categories
     *
     * @param string $organizationId
     * @return CustomerCategoriesResource
     * @throws iikoHttpException
     */
    public function GetCustomerCategories(string $organizationId) : CustomerCategoriesResource
    {
        $methodName = 'api/1/loyalty/iiko/customer_category';

        $url = iikoClient::baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CustomerCategoriesResource($response);
    }

    /**
     * Use this method to add specified category for customer
     *
     * @param string $customerId
     * @param string $categoryId
     * @param string $organizationId
     * @return AddedCategoriesResource
     * @throws iikoHttpException
     */
    public function AddCategory(string $customerId, string $categoryId, string $organizationId) : AddedCategoriesResource
    {
        $methodName = 'api/1/loyalty/iiko/customer_category/add';

        $url = iikoClient::baseUrl . "/" . $methodName;

        $requestData = [
            'customerId' => $customerId,
            'categoryId' => $categoryId,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new AddedCategoriesResource($response);
    }

    /**
     * Use this method to remove specified category for customer
     *
     * @param string $customerId
     * @param string $categoryId
     * @param string $organizationId
     * @return RemovedCategoriesResource
     * @throws iikoHttpException
     */
    public function RemoveCategory(string $customerId, string $categoryId, string $organizationId) : RemovedCategoriesResource
    {
        $methodName = 'api/1/loyalty/iiko/customer_category/remove';

        $url = iikoClient::baseUrl . "/" . $methodName;

        $requestData = [
            'customerId' => $customerId,
            'categoryId' => $categoryId,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new RemovedCategoriesResource($response);
    }
}
