<?php

namespace Omnipay\SepPay\Message;

class FetchBankListResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data[0]);
    }
}
