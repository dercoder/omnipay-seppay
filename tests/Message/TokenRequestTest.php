<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;

class TokenRequestTest extends TestCase
{
    /**
     * @var TokenRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new TokenRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey' => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('password', $data['grant_type']);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $data['ApiKey']);
    }

    public function testSendData()
    {
        $this->setMockHttpResponse('TokenSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\SepPay\Message\TokenResponse', $response);
    }
}
