<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;

class FetchBankListRequestTest extends TestCase
{
    /**
     * @var FetchBankListRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchBankListRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey'   => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'username' => 'TestUserX',
            'password' => 'KzsrfJbFrs2kK4G',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertCount(0, $data);
    }

    public function testSendData()
    {
        $this->setMockHttpResponse(['TokenSuccess.txt', 'FetchBankListSuccess.txt']);
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\SepPay\Message\FetchBankListResponse', $response);
    }
}
