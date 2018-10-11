<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $httpRequest = new HttpRequest([], [
            'Id'                 => '45',
            'Account'            => 'Account1',
            'Bank'               => 'Test1',
            'BankAccount'        => 'XYZ',
            'ExternalId'         => '96c99c82-af61-4efd-bd25-cd6dd5fda49c',
            'SourceAmount'       => '5.39',
            'SourceCurrency'     => '3',
            'SourceCurrencyCode' => 'AZN',
            'Amount'             => '12.43',
            'CurrencyCode'       => 'TRY',
            'Status'             => '1',
            'StatusName'         => 'Accepted',
            'ErrorCode'          => 'Error0',
            'CompleteDate'       => '2018-10-09T16:10:40.8135311Z',
            'User'               => 'User1',
            'Note'               => 'Some Info',
            'Signature'          => 'E3x2eewFyhAmvHcN3uGjvUrT61ywKYHQ+eNg7cv9O2Y=',
            'Name'               => 'John',
            'Surname'            => 'Doe',
            'FullName'           => 'John Doe',
        ]);

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'apiKey'   => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'username' => 'TestUserX',
            'password' => 'KzsrfJbFrs2kK4G',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame([
            'Id'                 => '45',
            'Account'            => 'Account1',
            'Bank'               => 'Test1',
            'BankAccount'        => 'XYZ',
            'ExternalId'         => '96c99c82-af61-4efd-bd25-cd6dd5fda49c',
            'SourceAmount'       => '5.39',
            'SourceCurrency'     => '3',
            'SourceCurrencyCode' => 'AZN',
            'Amount'             => '12.43',
            'CurrencyCode'       => 'TRY',
            'Status'             => '1',
            'StatusName'         => 'Accepted',
            'ErrorCode'          => 'Error0',
            'CompleteDate'       => '2018-10-09T16:10:40.8135311Z',
            'User'               => 'User1',
            'Note'               => 'Some Info',
            'Signature'          => 'E3x2eewFyhAmvHcN3uGjvUrT61ywKYHQ+eNg7cv9O2Y=',
            'Name'               => 'John',
            'Surname'            => 'Doe',
            'FullName'           => 'John Doe',
        ], $data);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\SepPay\Message\CompletePurchaseResponse', $response);
    }

    public function testInvalidSignature()
    {
        $this->request->setApiKey('1234');
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $this->request->getData();
    }
}
