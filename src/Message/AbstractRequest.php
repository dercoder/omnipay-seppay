<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Common\Exception\InvalidResponseException;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://api.seppay.net';

    /**
     * @var TokenResponse
     */
    protected static $accessToken;

    /**
     * Get SpeedPay API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set SpeedPay API key.
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
     * @param string $path
     *
     * @return string
     */
    protected function createUri($path)
    {
        return sprintf('%s/%s', $this->getEndpoint(), $path);
    }

    /**
     * @return array
     */
    protected function createHeaders()
    {
        $token = $this->getAccessToken();

        return [
            'Authorization' => 'Bearer ' . $token->getAccessToken(),
            'AccountGuid'   => $token->getAccountId(),
        ];
    }

    /**
     * @return TokenResponse
     * @throws InvalidResponseException
     */
    protected function getAccessToken()
    {
        if (static::$accessToken) {
            return static::$accessToken;
        }

        $request = new TokenRequest($this->httpClient, $this->httpRequest);
        $request->initialize($this->getParameters());

        /** @var TokenResponse $response */
        $response = $request->send();

        if (!$response->isSuccessful()) {
            throw new InvalidResponseException('Token request failed');
        }

        return static::$accessToken = $response;
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }
}
