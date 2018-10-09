<?php

namespace Omnipay\SepPay\Message;

class FetchBankListRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        return [];
    }

    /**
     * @param array $data
     *
     * @return FetchBankListResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('api/banks/all');
        $response = $this->httpClient
            ->post($uri, $this->createHeaders(), $data)
            ->send();

        $data = json_decode($response->getBody(true), true);
        return new FetchBankListResponse($this, $data);
    }
}
