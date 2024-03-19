<?php

namespace IikoApiLibrary\iiko\api\Extensions;

use Illuminate\Support\Facades\Http;
use IikoApiLibrary\Http\Resources\CustomerResources\AddedCardReousrce;
use IikoApiLibrary\Http\Resources\CustomerResources\AddedCustomerToProgramResource;
use IikoApiLibrary\Http\Resources\CustomerResources\CanceledHeldMoneyResource;
use IikoApiLibrary\Http\Resources\CustomerResources\CreatedOrUpdatedCustomerResource;
use IikoApiLibrary\Http\Resources\CustomerResources\CustomerInfoResource;
use IikoApiLibrary\Http\Resources\CustomerResources\DeletedCardResource;
use IikoApiLibrary\Http\Resources\CustomerResources\HoldedMoneyResource;
use IikoApiLibrary\Http\Resources\CustomerResources\RefilledBalanceResource;
use IikoApiLibrary\Http\Resources\CustomerResources\WithdrewBalanceResource;
use IikoApiLibrary\iiko\api\iikoClient;
use IikoApiLibrary\iiko\Exceptions\iikoHttpException;

trait CustomerExtension
{
    /**
     * Use this method to get customer's info
     *
     * @param string $item
     * @param string $type
     * @param string $organizationId
     * @return CustomerInfoResource
     */
    public function GetCustomerInfo(string $item, string $type, string $organizationId) : CustomerInfoResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/info';

        $url = iikoClient::baseUrl . "/" . $methodName;

        $requestData = [
            $type => $item,
            'type' => $type,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CustomerInfoResource($response);
    }

    /**
     * Use this method to get customer info by specified criterion.
     *
     * @param string $organizationId
     * @param int $sex
     * @param int $consentStatus
     * @param int|null $id
     * @param string|null $phone
     * @param string|null $cardTrack
     * @param string|null $cardNumber
     * @param string|null $name
     * @param string|null $middleName
     * @param string|null $surName
     * @param string|null $birthday
     * @param string|null $email
     * @param bool $shouldReceivePromoActionsInfo
     * @param string|null $referrerId
     * @param string|null $userData
     * @return CreatedOrUpdatedCustomerResource
     * @throws iikoHttpException
     */
    public function CreateOrUpdateCustomer(string $organizationId, int $sex, int $consentStatus, int $id = null, string $phone = null, string $cardTrack = null,
                                           string $cardNumber = null, string $name = null, string $middleName = null, string $surName = null,
                                           string $birthday = null, string $email = null, bool $shouldReceivePromoActionsInfo = true,
                                           string $referrerId = null, string $userData = null) : CreatedOrUpdatedCustomerResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/create_or_update';

        $url = iikoClient::baseUrl . "/" . $methodName;

        $requestData = [
            'id' => $id,
            'phone' => $phone,
            'cardTrack' => $cardTrack,
            'cardNumber' => $cardNumber,
            'name' => $name,
            'middleName' => $middleName,
            'surName' => $surName,
            'birthday' => $birthday,
            'email' => $email,
            'sex' => $sex,
            'consentStatus' => $consentStatus,
            'shouldReceivePromoActionsInfo' => $shouldReceivePromoActionsInfo,
            'referrerId' => $referrerId,
            'userData' => $userData,
            'organizationId' => $organizationId
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CreatedOrUpdatedCustomerResource($response);
    }

    /**
     * Use this method to add customer to program.
     *
     * @param string $customerId
     * @param string $programId
     * @param string $organizationId
     * @return AddedCustomerToProgramResource
     * @throws iikoHttpException
     */
    public function AddCustomerToProgram(string $customerId, string $programId, string $organizationId) : AddedCustomerToProgramResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/program/add';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'customerId' => $customerId,
            'programId' => $programId,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new AddedCustomerToProgramResource($response);
    }

    /**
     * Use this method to add new card for customer
     *
     * @param string $customerId
     * @param string $cardTrack
     * @param string $cardNumber
     * @param string $organizationId
     * @return AddedCardReousrce
     * @throws iikoHttpException
     */
    public function AddCard(string $customerId, string $cardTrack, string $cardNumber, string $organizationId) : AddedCardReousrce
    {
        $methodName = 'api/1/loyalty/iiko/customer/card/add';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'customerId' => $customerId,
            'cardTrack' => $cardTrack,
            'cardNumber' => $cardNumber,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new AddedCardReousrce($response);
    }

    /**
     * Use this method to delete existing card for customer
     *
     * @param string $customerId
     * @param string $cardTrack
     * @param string $organizationId
     * @return DeletedCardResource
     * @throws iikoHttpException
     */
    public function DeleteCard(string $customerId, string $cardTrack, string $organizationId) : DeletedCardResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/card/remove';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'customerId' => $customerId,
            'cardTrack' => $cardTrack,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new DeletedCardResource($response);
    }

    /**
     * Use this method to hold customer's money in loyalty program.
     * Payment will be process on POS during processing of an order
     *
     * @param string $customerId
     * @param string $walletId
     * @param Double $sum
     * @param string $organizationId
     * @param string|null $transactionId
     * @param string|null $comment
     * @return HoldedMoneyResource
     * @throws iikoHttpException
     */
    public function HoldMoney(string $customerId, string $walletId, float $sum, string $organizationId,
                              string $transactionId = null, string $comment = null) : HoldedMoneyResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/wallet/hold';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'customerId' => $customerId,
            'walletId' => $walletId,
            'sum' => $sum,
            'organizationId' => $organizationId,
            'transactionId' => $transactionId,
            'comment' => $comment,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new HoldedMoneyResource($response);
    }

    /**
     * Use this method to cancel holding transaction that created earlier
     *
     * @param string $transactionId
     * @param string $organizationId
     * @return CanceledHeldMoneyResource
     * @throws iikoHttpException
     */
    public function CancelHeldMoney(string $transactionId, string $organizationId) : CanceledHeldMoneyResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/wallet/cancel_hold';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'transactionId' => $transactionId,
            'organizationId' => $organizationId,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new CanceledHeldMoneyResource($response);
    }

    /**
     * Use this method to refill customer balance
     *
     * @param string $organizationId
     * @param string $customerId
     * @param string $walletId
     * @param float $sum
     * @param string|null $comment
     * @return RefilledBalanceResource
     * @throws iikoHttpException
     */
    public function RefillBalance(string $organizationId, string $customerId, string $walletId, float $sum,
                                  string $comment = null) : RefilledBalanceResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/wallet/topup';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'customerId' => $customerId,
            'walletId' => $walletId,
            'sum' => $sum,
            'comment' => $comment,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new RefilledBalanceResource($response);
    }

    /**
     * Use this method to withdraw customer balance
     *
     * @param string $organizationId
     * @param string $customerId
     * @param string $walletId
     * @param float $sum
     * @param string|null $comment
     * @return WithdrewBalanceResource
     * @throws iikoHttpException
     */
    public function WithdrawBalance(string $organizationId, string $customerId, string $walletId, float $sum,
                                    string $comment = null) : WithdrewBalanceResource
    {
        $methodName = 'api/1/loyalty/iiko/customer/wallet/chargeoff';

        $url = iikoClient::$baseUrl . "/" . $methodName;

        $requestData = [
            'organizationId' => $organizationId,
            'customerId' => $customerId,
            'walletId' => $walletId,
            'sum' => $sum,
            'comment' => $comment,
        ];

        $response = Http::withToken(iikoClient::$sessionToken)->post($url, $requestData);

        if($response->status() != 200)
            throw new iikoHttpException(
                $response->status(),
                $response->body());

        return new WithdrewBalanceResource($response);
    }
}
