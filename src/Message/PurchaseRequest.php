<?php

namespace Omnipay\SepPay\Message;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getParameter('firstName');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setFirstName($value)
    {
        return $this->setParameter('firstName', $value);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getParameter('lastName');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setLastName($value)
    {
        return $this->setParameter('lastName', $value);
    }

    /**
     * @return int
     */
    public function getBankId()
    {
        return $this->getParameter('bankId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setBankId($value)
    {
        return $this->setParameter('bankId', $value);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate(
            'username',
            'password',
            'firstName',
            'lastName',
            'amount',
            'currency',
            'bankId'
        );

        $data = [
            'Name'         => $this->getFirstName(),
            'Surname'      => $this->getLastName(),
            'CurrencyCode' => $this->getCurrency(),
            'Amount'       => $this->getAmount(),
            'BankId'       => $this->getBankId(),
            'Signature'    => $this->createSignature(),
        ];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('api/transaction/create');
        $response = $this->httpClient
            ->post($uri, $this->createHeaders(), $data)
            ->send();

        $data = json_decode($response->getBody(true), true);
        return new PurchaseResponse($this, $data);
    }

    /**
     * @return string
     */
    protected function createSignature()
    {
        return $this->encryptSignature([
            $this->getEncryptedUsername(),
            $this->getEncryptedPassword(),
            $this->getAmount(),
            $this->getBankId(),
            $this->getCurrency(),
            $this->getFirstName(),
            $this->getLastName(),
        ]);
    }
}
