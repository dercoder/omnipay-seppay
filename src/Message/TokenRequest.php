<?php

namespace Omnipay\SepPay\Message;

class TokenRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('apiKey');

        return [
            'grant_type' => 'password',
            'ApiKey'     => $this->getApiKey(),
        ];
    }

    /**
     * @param array $data
     *
     * @return TokenResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('token');
        $response = $this->httpClient
            ->post($uri)
            ->setBody(json_encode($data), 'application/json')
            ->send();

        $data = json_decode($response->getBody(true), true);
        return new TokenResponse($this, $data);
    }
}
