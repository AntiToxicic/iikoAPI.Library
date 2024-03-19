<?php

namespace IikoApiLibrary\iiko\api\Extensions;

use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\DiscountPromotionResources\CalculateCheckinResource;
use IikoApiLibrary\Http\Resources\DiscountPromotionResources\ConditionResource;
use IikoApiLibrary\Http\Resources\DiscountPromotionResources\CouponResource;
use IikoApiLibrary\Http\Resources\DiscountPromotionResources\CouponSeriesResource;
use IikoApiLibrary\Http\Resources\DiscountPromotionResources\NonActivatedCouponsResource;
use IikoApiLibrary\iiko\api\iikoClient;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

trait DiscountPromotionExtension
{
    /**
     * Use this method to calculate discounts and other loyalty items for an order
     *
     * @param object $order
     * @param string[] $availablePaymentMarketingCampaignIds
     * @param string[] $applicableManualConditions
     * @param object[] $dynamicDiscounts
     * @param bool $isLoyaltyTraceEnabled
     * @param string $organizationId
     * @param string|null $coupon
     * @param string|null $referrerId
     * @param string|null $terminalGroupId
     * @return CalculateCheckinResource
     * @throws iikoHttpException
     */
    public function CheckinCalculate(object  $order, array $availablePaymentMarketingCampaignIds, array $applicableManualConditions,
                                     array  $dynamicDiscounts, bool $isLoyaltyTraceEnabled, string $organizationId,
                                     string $coupon = null, string $referrerId = null, string $terminalGroupId = null
                                    ): CalculateCheckinResource
    {
        $methodName = 'api/1/loyalty/iiko/calculate';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'order' => $order,
            'coupon' => $coupon,
            'referrerId' => $referrerId,
            'terminalGroupId' => $terminalGroupId,
            'availablePaymentMarketingCampaignIds' => $availablePaymentMarketingCampaignIds,
            'applicableManualConditions' => $applicableManualConditions,
            'dynamicDiscounts' => $dynamicDiscounts,
            'isLoyaltyTraceEnabled' => $isLoyaltyTraceEnabled,
            'organizationId' => $organizationId
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CalculateCheckinResource($response);
    }

    /**
     * Use this method to get all organization's manual conditions
     *
     * @param string $organizationId
     * @return ConditionResource
     * @throws iikoHttpException
     */
    public function GetManualConditions(string $organizationId) : ConditionResource
    {
        $methodName = 'api/1/loyalty/iiko/manual_condition';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new ConditionResource($response);
    }

    /**
     * Use this method to get all loyalty programs for organization
     *
     * @param string $organizationId
     * @param bool|null $withoutMarketingCampaigns
     * @return ConditionResource
     * @throws iikoHttpException
     */
    public function GetPrograms(string $organizationId, bool $withoutMarketingCampaigns = null) : ConditionResource
    {
        $methodName = 'api/1/loyalty/iiko/program';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'withoutMarketingCampaigns' => $withoutMarketingCampaigns
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new ConditionResource($response);
    }

    /**
     * Use this method to get information about the specified coupon
     *
     * @param string $organizationId
     * @param string $number
     * @param string|null $series
     * @return CouponResource
     * @throws iikoHttpException
     */
    public function GetCouponInfo(string $organizationId, string $number, string $series = null) : CouponResource
    {
        $methodName = 'api/1/loyalty/iiko/coupons/info';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'number' => $number,
            'series' => $series
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CouponResource($response);
    }

    /**
     * Use this method to get a list of coupon series in which there are not deleted and not activated coupons
     *
     * @param string $organizationId
     * @return CouponSeriesResource
     * @throws iikoHttpException
     */
    public function GetCouponSeries(string $organizationId) : CouponSeriesResource
    {
        $methodName = 'api/1/loyalty/iiko/coupons/series';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CouponSeriesResource($response);
    }

    /**
     * Use this method to get list of non-activated coupons
     *
     * @param string $organizationId
     * @param string $series
     * @param int $pageSize
     * @param int $page
     * @return NonActivatedCouponsResource
     * @throws iikoHttpException
     */
    public function GetNonActivatedCoupons(string $organizationId, string $series, int $pageSize = 0, int $page = 0) : NonActivatedCouponsResource
    {
        $methodName = 'api/1/loyalty/iiko/coupons/by_series';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'series' => $series,
            'pageSize' => $pageSize,
            'page' => $page
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new NonActivatedCouponsResource($response);
    }
}
