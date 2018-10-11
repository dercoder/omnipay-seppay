<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Symfony\Component\HttpFoundation\ParameterBag;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $request = $this->httpRequest->request;

        if ($this->createSignature($request) !== $request->get('Signature')) {
            throw new InvalidRequestException('Invalid signature');
        }

        return $request->all();
    }

    /**
     * @param array $data
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }

    /**
     * @param ParameterBag $bag
     *
     * @return string
     */
    protected function createSignature(ParameterBag $bag)
    {
        return $this->encryptSignature([
            $this->getEncryptedUsername(),
            $this->getEncryptedPassword(),
            $bag->get('Amount'),
            $bag->get('Bank'),
            $bag->get('CurrencyCode'),
            $bag->get('ExternalId'),
            $bag->get('Name'),
            $bag->get('Status'),
            $bag->get('Surname'),
        ]);
    }
}
