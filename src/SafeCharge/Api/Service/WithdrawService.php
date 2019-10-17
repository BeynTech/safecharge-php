<?php


namespace SafeCharge\Api\Service;

use SafeCharge\Api\Exception\ConfigurationException;
use SafeCharge\Api\RestClient;
use SafeCharge\Api\Utils;

/**
 * Class WithdrawService
 * @package SafeCharge\Api\Service
 */
class WithdrawService extends BaseService
{
    /**
     * PaymentService constructor.
     * @param RestClient $client
     * @throws ConfigurationException
     */
    public function __construct(RestClient $client)
    {
        parent::__construct($client);
        $this->apiUrl = $this->client->getWithdraralUrl();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function approveRequest(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'userAccountId',
            'operatorName',
            'comment',
            'successUrl',
            'failUrl',
            'selectedWdType',
            'timeStamp',
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'approveRequest.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function cancelRequest(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'wdRequestId',
            'merchantWDRequestId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'wdRequestId',
            'merchantWDRequestId',
            'userAccountId',
            'timeStamp'
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'cancelRequest.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function declineRequest(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'userAccountId',
            'operatorName',
            'comment',
            'timeStamp'
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'declineRequest.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function placeWithdrawalOrder(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'merchantUniqueId',
            'userPMId',
            'amount',
            'currency',
            'settlementType',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'merchantUniqueId',
            'userPMId',
            'amount',
            'currency',
            'settlementType',
            'gwRelatedTransactionId',
            'userAccountId',
            'operatorName',
            'comment',
            'successUrl',
            'failUrl',
            'selectedWdType',
            'timeStamp'
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'placeWithdrawalOrder.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function sealRequest(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'merchantWDRequestId',
            'userAccountId',
            'operatorName',
            'comment',
            'timeStamp'
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'sealRequest.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function submitRequest(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'userToken',
            'userPMId',
            'userDetails',
            'amount',
            'currency',
            'merchantWDRequestId',
            'merchantUniqueId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'userTokenId',
            'userPMId',
            'userDetails',
            'amount',
            'currency',
            'merchantWDRequestId',
            'merchantUniqueId',
            'userAccountId',
            'customSiteName',
            'customFieldX',
            'successUrl',
            'failUrl',
            'selectedWdType',
            'timeStamp',
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'submitRequest.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function getCandidatesForRefund(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'timeStamp',
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'getCandidatesForRefund.do');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \SafeCharge\Api\Exception\ConnectionException
     * @throws \SafeCharge\Api\Exception\ResponseException
     * @throws \SafeCharge\Api\Exception\ValidationException
     */
    public function getRequests(array $params)
    {
        $mandatoryFields = [
            'merchantId',
            'merchantSiteId',
            'wdRequestId',
            'timeStamp',
            'checksum'
        ];

        $checksumParametersOrder = [
            'merchantId',
            'merchantSiteId',
            'wdRequestOrderCount',
            'userTokenId',
            'userId',
            'wdRequestId',
            'merchantWDRequestId',
            'merchantUniqueId',
            'dateRange',
            'statusList',
            'stateList',
            'paymentMethodsList',
            'countryIsoList',
            'amountRange',
            'userRegistrationDateRange',
            'sortField',
            'sortOrder',
            'firstResult',
            'maxResults',
            'operatorName',
            'wdRequestOrderCountRange',
            'merchantSiteIds',
            'optionalWdType',
            'timeStamp',
        ];

        $params = $this->appendMerchantIdMerchantSiteIdTimeStamp($params);

        $params['checksum'] = Utils::calculateChecksum($params, $checksumParametersOrder, $this->client->getConfig()->getMerchantSecretKey(), $this->client->getConfig()->getHashAlgorithm());

        $this->validate($params, $mandatoryFields);

        return $this->requestJson($params, 'getCandidatesForRefund.do');
    }
}