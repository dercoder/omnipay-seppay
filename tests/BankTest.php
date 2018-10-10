<?php

namespace Omnipay\SepPay;

use Omnipay\Tests\TestCase;

class BankTest extends TestCase
{
    /**
     * @var Bank
     */
    public $bank;

    public function setUp()
    {
        parent::setUp();
        $this->bank = new Bank([
            'Id'   => '544',
            'Name' => 'Akbank',
        ]);
    }

    public function testBank()
    {
        $this->assertSame(544, $this->bank->getId());
        $this->assertSame('Akbank', $this->bank->getName());
    }
}