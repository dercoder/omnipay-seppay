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
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

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
     * Get SepPay API username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set SepPay API username.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * Get SepPay API password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set SepPay API password.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * @return string
     */
    public function getEncryptedUsername()
    {
        return $this->encryptData($this->getUsername());
    }

    /**
     * @return string
     */
    public function getEncryptedPassword()
    {
        return $this->encryptData($this->getPassword());
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
            'Content-Type'  => 'application/x-www-form-urlencoded; charset=utf-8',
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
        $request = new TokenRequest($this->httpClient, $this->httpRequest);
        $request->initialize($this->getParameters());

        /** @var TokenResponse $response */
        $response = $request->send();

        if (!$response->isSuccessful()) {
            throw new InvalidResponseException('Token request failed');
        }

        return $response;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function encryptData($string)
    {
        $encrypted = openssl_encrypt($string, 'aes-128-ecb', $this->getApiKey(), OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }

    /**
     * @param array $array
     *
     * @return string
     */
    protected function encryptSignature(array $array)
    {
        $string = implode('', $array);
        $encrypted = openssl_encrypt($string, 'aes-128-ecb', $this->getApiKey(), OPENSSL_RAW_DATA);
        $hash = hash('sha256', $encrypted, true);

        return base64_encode($hash);
    }
}
