<?php

namespace Omnipay\SepPay\Message;

use \Omnipay\Common\Message\AbstractResponse;

class TokenResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return (bool)$this->getAccessToken();
    }

    /**
     * @return string|null
     */
    public function getAccessToken()
    {
        return isset($this->data['access_token']) ? $this->data['access_token'] : null;
    }

    /**
     * @return string|null
     */
    public function getTokenType()
    {
        return isset($this->data['token_type']) ? $this->data['token_type'] : null;
    }

    /**
     * @return int|null
     */
    public function getExpiresIn()
    {
        return isset($this->data['expires_in']) ? (int)$this->data['expires_in'] : null;
    }

    /**
     * @return string|null
     */
    public function getAccountId()
    {
        return isset($this->data['accountId']) ? $this->data['accountId'] : null;
    }

    /**
     * @return string|null
     */
    public function getRole()
    {
        return isset($this->data['Role']) ? $this->data['Role'] : null;
    }

    /**
     * @return string|null
     */
    public function getIssuedDate()
    {
        return isset($this->data['.issued']) ? $this->data['.issued'] : null;
    }

    /**
     * @return string|null
     */
    public function getExpiresDate()
    {
        return isset($this->data['.expires']) ? $this->data['.expires'] : null;
    }
}
