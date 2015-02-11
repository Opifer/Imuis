<?php

namespace Opifer\Imuis\Model;

/**
 * Journal
 *
 * @author Rick van Laarhoven <r.vanlaarhoven@opifer.nl>
 */
class Journal
{
    /**
     * Year (JR)
     *
     * @var integer
     */
    protected $year;

    /**
     * Period (PN)
     *
     * @var integer
     */
    protected $period;

    /**
     * Journal (DAGB)
     *
     * @var integer
     */
    protected $journal;

    /**
     * Account (REK)
     *
     * @var integer
     */
    protected $account;

    /**
     * Contra account (TEGREK)
     *
     * @var integer
     */
    protected $contraAccount;

    /**
     * Invoice (FACT)
     *
     * @var integer
     */
    protected $invoice;

    /**
     * Amount (BEDRBOEK)
     *
     * @var decimal
     */
    protected $amount;

    /**
     * Tax Code (BTW)
     *
     * @var integer
     */
    protected $taxCode;

    /**
     * Tax amount (BEDRBTW)
     *
     * @var decimal
     */
    protected $taxAmount;

    /**
     * Booking date (DAT)
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * Comment (OPM)
     *
     * @var string
     */
    protected $comment;

    /**
     * Description (OMSCHR)
     *
     * @var string
     */
    protected $description;

    /**
     * External invoice (BOEKSTUK)
     *
     * @var string
     */
    protected $externalInvoice;

    /**
     * Set year
     *
     * @param integer $year
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        if (null === $this->year) {
            $this->year = $this->getDate()->format('Y');
        }

        return $this->year;
    }

    /**
     * Set period
     *
     * @param integer $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set journal
     *
     * @param integer $journal
     */
    public function setJournal($journal)
    {
        $this->journal = $journal;

        return $this;
    }

    /**
     * Get journal
     *
     * @return integer
     */
    public function getJournal()
    {
        return $this->journal;
    }

    /**
     * Set account
     *
     * @param Creditor $account
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return integer
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set contraAccount
     *
     * @param integer $contraAccount
     */
    public function setContraAccount($contraAccount)
    {
        $this->contraAccount = $contraAccount;

        return $this;
    }

    /**
     * Get contraAccount
     *
     * @return integer
     */
    public function getContraAccount()
    {
        return $this->contraAccount;
    }

    /**
     * Set invoice
     *
     * @param integer $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return integer
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set amount
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set taxCode
     *
     * @param integer $taxCode
     */
    public function setTaxCode($taxCode)
    {
        $this->taxCode = $taxCode;

        return $this;
    }

    /**
     * Get taxCode
     *
     * @return integer
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }

    /**
     * Set taxAmount
     *
     * @param float $taxAmount
     */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    /**
     * Get taxAmount
     *
     * @return float
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get Comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set externalInvoice
     *
     * @param integer $externalInvoice
     */
    public function setExternalInvoice($externalInvoice)
    {
        $this->externalInvoice = $externalInvoice;

        return $this;
    }

    /**
     * Get externalInvoice
     *
     * @return integer
     */
    public function getExternalInvoice()
    {
        return $this->externalInvoice;
    }

    /**
     * Transform the journal to an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'BOE' => [
                'JR' => $this->getYear(),
                'PN' => $this->getPeriod(),
                'DAGB' => $this->getJournal(),
                'REK' => $this->getAccount(),
                'TEGREK' => $this->getContraAccount(),
                'FACT' => $this->getInvoice(),
                'BTW' => $this->getTaxCode(),
                'BEDRBOEK' => $this->getAmount(),
                'DAT' => $this->getDate()->format('d-m-Y'),
                'OPM' => $this->getComment(),
                'BEDRBTW' => $this->getTaxAmount(),
                'OMSCHR' => $this->getDescription(),
                'BOEKSTUK' => $this->getExternalInvoice()
            ]
        ];
    }

    /**
    * Transform the object to an XML Element
    *
    * @return \SimpleXMLElement
    */
    public function toXml($xml = null, array $array = null)
    {
        if (null === $xml) {
            $xml = new \SimpleXMLElement('<DATASET></DATASET>');
        }

        if (null === $array) {
            $array = $this->toArray();
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $sub = $xml->addChild($key);

                $this->toXml($sub, $value);
            } else {
                $xml->addChild($key, $value);
            }
        }

        return $xml;
    }
}
