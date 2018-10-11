<?php

namespace Omnipay\SepPay\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseResponseTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $response = new CompletePurchaseResponse($this->request, [
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

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(1, $response->getCode());
        $this->assertSame('Accepted', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('96c99c82-af61-4efd-bd25-cd6dd5fda49c', $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('TRY', $response->getCurrency());
        $this->assertSame(5.3899999999999997, $response->getSourceAmount());
        $this->assertSame('AZN', $response->getSourceCurrency());
    }

    public function testFailure()
    {
        $response = new CompletePurchaseResponse($this->request, [
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
            'Status'             => '2',
            'StatusName'         => 'Declined',
            'ErrorCode'          => 'Error0',
            'CompleteDate'       => '2018-10-09T16:10:40.8135311Z',
            'User'               => 'User1',
            'Note'               => 'Some Info',
            'Signature'          => 'E3x2eewFyhAmvHcN3uGjvUrT61ywKYHQ+eNg7cv9O2Y=',
            'Name'               => 'John',
            'Surname'            => 'Doe',
            'FullName'           => 'John Doe',
        ]);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(2, $response->getCode());
        $this->assertSame('Declined', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame('96c99c82-af61-4efd-bd25-cd6dd5fda49c', $response->getTransactionReference());
    }
}
