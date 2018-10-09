<?php

namespace Omnipay\SepPay;

class Bank
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * Bank constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return isset($this->data['Id']) ? (int)$this->data['Id'] : null;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return isset($this->data['Name']) ? $this->data['Name'] : null;
    }
}
