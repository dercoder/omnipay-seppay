<?php

namespace Omnipay\SepPay\Message;

use Omnipay\SepPay\Bank;
use Omnipay\Tests\TestCase;

class FetchBankListResponseTest extends TestCase
{
    /**
     * @var FetchBankListRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchBankListRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('FetchBankListSuccess.txt');
        $response = new FetchBankListResponse($this->request, json_decode($httpResponse->getBody(true), true));
        $list = $response->getList();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertCount(1, $list);
        $this->assertInstanceOf('\Omnipay\SepPay\Bank', $list[0]);
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('FetchBankListFailure.txt');
        $response = new FetchBankListResponse($this->request, json_decode($httpResponse->getBody(true), true));
        $list = $response->getList();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertCount(0, $list);
    }
}
