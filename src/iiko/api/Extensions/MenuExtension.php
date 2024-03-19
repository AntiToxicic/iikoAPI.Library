<?php

namespace IikoApiLibrary\iiko\api\Extensions;

use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\MenuResources\AddedItemsResource;
use IikoApiLibrary\Http\Resources\MenuResources\CalculatedCombosInfoResource;
use IikoApiLibrary\Http\Resources\MenuResources\CheckedOutOfStockItemsResource;
use IikoApiLibrary\Http\Resources\MenuResources\ClearedItemsResource;
use IikoApiLibrary\Http\Resources\MenuResources\CombosInfoResource;
use IikoApiLibrary\Http\Resources\MenuResources\ExternalMenuResource;
use IikoApiLibrary\Http\Resources\MenuResources\MenuResource;
use IikoApiLibrary\Http\Resources\MenuResources\MenusWithPriceResource;
use IikoApiLibrary\Http\Resources\MenuResources\OutOfStockItemsResource;
use IikoApiLibrary\Http\Resources\MenuResources\RemovedItemsResource;
use IikoApiLibrary\iiko\api\iikoClient;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

trait MenuExtension
{
    /**
     * Use this method for Export Menu.
     *
     * @param string $organizationId this is ID of certain organization.
     * @param int|null $startRevision Initial revision. Items list will be received only in case there is a newer revision in the database.
     * @return MenuResource Menu in json.
     * @throws iikoHttpException
     */
    public function ExportMenu(string $organizationId, int $startRevision = null) : MenuResource
    {
        $methodName = 'api/1/nomenclature';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'startRevision' => $startRevision
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new MenuResource($response);
    }


    /**
     *  Use this method for Export Menu with prices
     *
     * @return MenusWithPriceResource
     * @throws iikoHttpException
     */
    public function ExportMenusWithPrice() : MenusWithPriceResource
    {
        $methodName = 'api/2/menu';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $response = Http::withToken(iikoClient::$sessionToken)->post($url);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new MenusWithPriceResource($response);
    }

    /**
     * Use this method to retrieve external menu by ID.
     *
     * @param string $externalMenuId
     * @param string[] $organizationIds
     * @param string|null $priceCategoryId
     * @param int|null $version
     * @param string|null $language
     * @param int|null $startRevision
     * @return ExternalMenuResource
     * @throws iikoHttpException
     */
    public function GetMenuById(string $externalMenuId, array $organizationIds, string $priceCategoryId = null,
                                int $version = null, string $language = null, int $startRevision = null): ExternalMenuResource
    {
        $methodName = 'api/2/menu/by_id';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'externalMenuId' => $externalMenuId,
            'organizationIds' => $organizationIds,
            'priceCategoryId' => $priceCategoryId,
            'version' => $version,
            'language' => $language,
            'startRevision' => $startRevision
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new ExternalMenuResource($response);
    }

    /**
     * Use this method to get stop lists
     *
     * @param string $organizationIds
     * @param bool $returnSize
     * @param int[]|null $terminalGroupsIds
     * @return OutOfStockItemsResource
     * @throws iikoHttpException
     */
    public function GetOutOfStockItems(string $organizationIds, bool $returnSize = false,
                                       array  $terminalGroupsIds = null) : OutOfStockItemsResource
    {
        $methodName = 'api/1/stop_lists';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationIds' => $organizationIds,
            'returnSize' => $returnSize,
            'terminalGroupsIds' => $terminalGroupsIds
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new OutOfStockItemsResource($response);
    }

    /**
     * Use this method ot check items in stop list
     *
     * @param string $organizationId
     * @param string $terminalGroupId
     * @param object[] $items
     * @return CheckedOutOfStockItemsResource
     * @throws iikoHttpException
     */
    public function CheckItemsInOutOfStockItems(string $organizationId, string $terminalGroupId,
                                                array  $items) : CheckedOutOfStockItemsResource
    {
        $methodName = 'api/1/stop_lists/check';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'terminalGroupId' => $terminalGroupId,
            'items' => $items,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CheckedOutOfStockItemsResource($response);
    }

    /**
     * Use this method to add items to stop list
     *
     * @param string $organizationId
     * @param string $terminalGroupId
     * @param object[] $items
     * @return AddedItemsResource
     * @throws iikoHttpException
     */
    public function AddItemsToOutOfStockList(string $organizationId, string $terminalGroupId,
                                             array  $items) : AddedItemsResource
    {
        $methodName = 'api/1/stop_lists/add';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'terminalGroupId' => $terminalGroupId,
            'items' => $items,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new AddedItemsResource($response);
    }

    /**
     * Use this method to remove items to stop list
     *
     * @param string $organizationId
     * @param string $terminalGroupId
     * @param object[] $items
     * @return RemovedItemsResource
     * @throws iikoHttpException
     */
    public function RemoveItemsToOutOfStockList(string $organizationId, string $terminalGroupId,
                                                array  $items) : RemovedItemsResource
    {
        $methodName = 'api/1/stop_lists/remove';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'terminalGroupId' => $terminalGroupId,
            'items' => $items,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new RemovedItemsResource($response);
    }

    /**
     * Use this method to clear stop list
     *
     * @param string $organizationId
     * @param string $terminalGroupId
     * @return ClearedItemsResource
     * @throws iikoHttpException
     */
    public function ClearOutOfStockList(string $organizationId, string $terminalGroupId) : ClearedItemsResource
    {
        $methodName = 'api/1/stop_lists/clear';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'terminalGroupId' => $terminalGroupId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new ClearedItemsResource($response);
    }

    /**
     * Use this method to get info about combos
     *
     * @param string $organizationId
     * @param true|null $extraData
     * @return CombosInfoResource
     * @throws iikoHttpException
     */
    public function GetCombosInfo(string $organizationId, bool $extraData = true) : CombosInfoResource
    {
        $methodName = 'api/1/combo';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'extraData' => $extraData,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CombosInfoResource($response);
    }

    /**
     * Use this method to make combo price calculation.
     *
     * @param string $organizationId
     * @param object[] $items
     * @return CalculatedCombosInfoResource
     * @throws iikoHttpException
     */
    public function CalculateComboPrice(string $organizationId, array $items) : CalculatedCombosInfoResource
    {
        $methodName = 'api/1/combo/calculate';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'items' => $items,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CalculatedCombosInfoResource($response);
    }
}
