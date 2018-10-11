<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;

class TokenResponseTest extends TestCase
{
    /**
     * @var TokenRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new TokenRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('TokenSuccess.txt');
        $response = new TokenResponse($this->request, json_decode($httpResponse->getBody(true), true));

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('zC8sZbOve-bOhfMTndKqDf2vdsQHz4zNhCaIl', $response->getAccessToken());
        $this->assertSame('bearer', $response->getTokenType());
        $this->assertSame(86399, $response->getExpiresIn());
        $this->assertSame('wpkxf7f4zx8o95ba', $response->getAccountId());
        $this->assertSame('account', $response->getRole());
        $this->assertSame('Thu, 11 Oct 2018 20:12:10 GMT', $response->getIssuedDate());
        $this->assertSame('Fri, 12 Oct 2018 20:12:10 GMT', $response->getExpiresDate());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('TokenFailure.txt');
        $response = new TokenResponse($this->request, json_decode($httpResponse->getBody(true), true));

        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getAccessToken());
        $this->assertNull($response->getTokenType());
        $this->assertNull($response->getExpiresIn());
        $this->assertNull($response->getAccountId());
        $this->assertNull($response->getRole());
        $this->assertNull($response->getIssuedDate());
        $this->assertNull($response->getExpiresDate());
    }
}
