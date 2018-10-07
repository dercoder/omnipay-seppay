<?php

namespace Omnipay\SepPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\SepPay\Message\FetchBankListRequest;
use Omnipay\SepPay\Message\PurchaseRequest;
use Omnipay\SepPay\Message\CompletePurchaseRequest;

class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'SepPay';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'apiKey'   => '',
            'testMode' => false,
        ];
    }

    /**
     * Get SepPay API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set SepPay API key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|FetchBankListRequest
     */
    public function fetchBankList(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SepPay\Message\FetchBankListRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SepPay\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SepPay\Message\CompletePurchaseRequest', $parameters);
    }
}
