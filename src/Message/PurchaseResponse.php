<?php

namespace Omnipay\SepPay\Message;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['ExternalId']) ? $this->data['ExternalId'] : null;
    }

    /**
     * @return string|null
     */
    public function getAccountName()
    {
        return isset($this->data['AccountName']) ? $this->data['AccountName'] : null;
    }

    /**
     * @return string|null
     */
    public function getAccountNumber()
    {
        return isset($this->data['AccountNumber']) ? $this->data['AccountNumber'] : null;
    }

    /**
     * @return string|null
     */
    public function getBankName()
    {
        return isset($this->data['BankName']) ? $this->data['BankName'] : null;
    }

    /**
     * @return string|null
     */
    public function getBankAddress()
    {
        return isset($this->data['BankAddress']) ? $this->data['BankAddress'] : null;
    }

    /**
     * @return string|null
     */
    public function getFilialCode()
    {
        return isset($this->data['FilialCode']) ? $this->data['FilialCode'] : null;
    }

    /**
     * @return string|null
     */
    public function getIban()
    {
        return isset($this->data['IBAN']) ? $this->data['IBAN'] : null;
    }

    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return isset($this->data['Name']) ? $this->data['Name'] : null;
    }

    /**
     * @return string|null
     */
    public function getLastName()
    {
        return isset($this->data['Surname']) ? $this->data['Surname'] : null;
    }

    /**
     * @return float|null
     */
    public function getAmount()
    {
        return isset($this->data['Amount']) ? (float)$this->data['Amount'] : null;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return isset($this->data['CurrencyCode']) ? $this->data['CurrencyCode'] : null;
    }

    /**
     * @return float|null
     */
    public function getSourceAmount()
    {
        return isset($this->data['SourceAmount']) ? (float)$this->data['SourceAmount'] : null;
    }

    /**
     * @return string|null
     */
    public function getSourceCurrency()
    {
        return isset($this->data['SourceCurrency']) ? $this->data['SourceCurrencyCode'] : null;
    }

    /**
     * @return string|null
     */
    public function getCreatedDate()
    {
        return isset($this->data['CreatedOn']) ? $this->data['CreatedOn'] : null;
    }
}
