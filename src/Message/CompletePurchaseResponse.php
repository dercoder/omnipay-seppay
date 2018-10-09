<?php

namespace Omnipay\SepPay\Message;

class CompletePurchaseResponse extends PurchaseResponse
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
}
