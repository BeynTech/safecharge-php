<?php


namespace SafeCharge\Api;

use SafeCharge\Api\Service\AuthenticationManagement;
use SafeCharge\Api\Service\BaseService;
use SafeCharge\Api\Service\Payments\ThreeDsecure;
use SafeCharge\Api\Service\PaymentService;
use SafeCharge\Api\Service\UserService;
use SafeCharge\Api\Service\WithdrawService;

class SafeCharge
{
    /**
     * @var RestClient
     */
    private $client;

    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * @var ThreeDsecure
     */
    private $securePaymentService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var WithdrawService
     */
    private $withdrawService;

    /**
     * @var AuthenticationManagement
     */
    private $baseService;

    /**
     * SafeCharge constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        if (!empty($params)) {
            $this->client = new RestClient($params);
        }
    }

    /**
     * @param array $params
     */
    public function initialize(array $params)
    {
        $this->client = new RestClient($params);
    }

    /**
     * Set the Logger object
     *
     * @param $logger
     */
    public function setLogger($logger)
    {
        $this->client->setLogger($logger);
    }


    /**
     * @return mixed
     * @throws Exception\ConfigurationException
     * @throws Exception\ConnectionException
     * @throws Exception\ResponseException
     * @throws Exception\ValidationException
     */
    public function getSessionToken()
    {
        return $this->getBaseService()->getSessionToken();
    }

    /**
     * @return PaymentService
     * @throws Exception\ConfigurationException
     */
    public function getPaymentService()
    {
        if (is_null($this->paymentService)) {
            $this->paymentService = new PaymentService($this->client);
        }
        return $this->paymentService;
    }

    /**
     * @return UserService
     * @throws Exception\ConfigurationException
     */
    public function getUserService()
    {
        if (is_null($this->userService)) {
            $this->userService = new UserService($this->client);
        }
        return $this->userService;
    }

    /**
     * @return AuthenticationManagement
     * @throws Exception\ConfigurationException
     */
    private function getBaseService()
    {
        if (is_null($this->baseService)) {
            $this->baseService = new BaseService($this->client);
        }
        return $this->baseService;
    }

    /**
     * @return ThreeDsecure
     * @throws Exception\ConfigurationException
     */
    public function getSecurePaymentService()
    {
        if (is_null($this->paymentService)) {
            $this->securePaymentService = new ThreeDsecure($this->client);
        }
        return $this->securePaymentService;
    }

    /**
     * @return WithdrawService
     * @throws Exception\ConfigurationException
     */
    public function getWithdrawService()
    {
        if (is_null($this->withdrawService)) {
            $this->withdrawService = new WithdrawService($this->client);
        }
        return $this->withdrawService;
    }
}
