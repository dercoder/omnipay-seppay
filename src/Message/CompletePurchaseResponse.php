<?php

namespace Omnipay\SepPay\Message;

use \Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === 1;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return false;
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['Status']) ? (int)$this->data['Status'] : null;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return isset($this->data['StatusName']) ? $this->data['StatusName'] : null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['ExternalId']) ? $this->data['ExternalId'] : null;
    }

    /**
     * @return float|null
     */
    public function getAmount()
    {
        return isset($this->data['Amount']) ? (float)$this->data['Amount'] : null;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return isset($this->data['CurrencyCode']) ? $this->data['CurrencyCode'] : null;
    }

    /**
     * @return float|null
     */
    public function getSourceAmount()
    {
        return isset($this->data['SourceAmount']) ? (float)$this->data['SourceAmount'] : null;
    }

    /**
     * @return string|null
     */
    public function getSourceCurrency()
    {
        return isset($this->data['SourceCurrencyCode']) ? $this->data['SourceCurrencyCode'] : null;
    }
}
