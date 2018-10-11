<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey'    => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'username'  => 'TestUserX',
            'password'  => 'KzsrfJbFrs2kK4G',
            'bankId'    => 17,
            'firstName' => 'John',
            'lastName'  => 'Doe',
            'amount'    => 12.43,
            'currency'  => 'TRY',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('John', $data['Name']);
        $this->assertSame('Doe', $data['Surname']);
        $this->assertSame(17, $data['BankId']);
        $this->assertSame('12.43', $data['Amount']);
        $this->assertSame('TRY', $data['CurrencyCode']);
        $this->assertSame('cgk+8rc0Bgu1daOK/PcoH34U/xvNcgl9Ojt5yBQveR8=', $data['Signature']);
    }

    public function testInvalidToken()
    {
        $this->setMockHttpResponse('TokenInvalid.txt');
        $data = $this->request->getData();
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidResponseException');
        $this->request->sendData($data);
    }

    public function testSendData()
    {
        $this->setMockHttpResponse(['TokenSuccess.txt', 'PurchaseSuccess.txt']);
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\SepPay\Message\PurchaseResponse', $response);
    }
}
