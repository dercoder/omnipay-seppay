<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;

class PayoutResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new PurchaseResponse($this->request, json_decode($httpResponse->getBody(true), true));

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertTrue($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('5c1838c7-4ec7-4731-8290-e07b062633da', $response->getTransactionReference());
        $this->assertSame('Max Mustermann', $response->getAccountName());
        $this->assertSame('5678', $response->getAccountNumber());
        $this->assertSame('Test1', $response->getBankName());
        $this->assertSame('TEST', $response->getBankAddress());
        $this->assertSame('Fil123', $response->getFilialCode());
        $this->assertSame('AZ123414123', $response->getIban());
        $this->assertSame('John', $response->getFirstName());
        $this->assertSame('Doe', $response->getLastName());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('TRY', $response->getCurrency());
        $this->assertSame(5.389211612752498, $response->getSourceAmount());
        $this->assertSame('AZN', $response->getSourceCurrency());
        $this->assertSame('2018-10-11T20:09:27.681941Z', $response->getCreatedDate());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new PurchaseResponse($this->request, json_decode($httpResponse->getBody(true), true));

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getTransactionId());
    }
}
