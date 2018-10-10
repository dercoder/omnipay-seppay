<?php

namespace Omnipay\SepPay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setApiKey('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936');
        $this->gateway->setUsername('TestUserX');
        $this->gateway->setPassword('KzsrfJbFrs2kK4G');
    }

    public function testCredentials()
    {
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $this->gateway->getApiKey());
        $this->assertSame('TestUserX', $this->gateway->getUsername());
        $this->assertSame('KzsrfJbFrs2kK4G', $this->gateway->getPassword());
    }

    public function testFetchBankList()
    {
        $request = $this->gateway->fetchBankList();
        $this->assertInstanceOf('\Omnipay\SepPay\Message\FetchBankListRequest', $request);
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'bankId'   => 17,
            'name'     => 'John Doe',
            'amount'   => 12.43,
            'currency' => 'TRY',
        ]);

        $this->assertInstanceOf('\Omnipay\SepPay\Message\PurchaseRequest', $request);
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase();
        $this->assertInstanceOf('\Omnipay\SepPay\Message\CompletePurchaseRequest', $request);
    }
}
