<?php

namespace Opifer\Imuis\Model;

/**
 * Creditor
 *
 * @author Rick van Laarhoven <r.vanlaarhoven@opifer.nl>
 */
class Creditor
{
    /**
     * @var string
     */
    private $table = 'CRE';

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $bankAccount;

    /**
     * @var integer
     */
    protected $user;

    /**
     * @var street
     */
    protected $street;

    /**
     * @var integer
     */
    protected $houseNumber;

    /**
     * @var string
     */
    protected $houseNumberAddon;

    /**
     * @var string
     */
    protected $postcode;

    /**
     * @var string
     */
    protected $city;

    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get ID
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set bank account
     *
     * @param string $bankAccount
     */
    public function setBankAccount($bankAccount)
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    /**
     * Get bank account
     *
     * @return string
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    /**
     * Set user
     *
     * @param integer $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set street
     *
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set house number
     *
     * @param integer $houseNumber
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get house number
     *
     * @return integer
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set house number addon
     *
     * @param string $houseNumberAddon
     */
    public function setHouseNumberAddon($houseNumberAddon)
    {
        $this->houseNumberAddon = $houseNumberAddon;

        return $this;
    }

    /**
     * Get house number addon
     *
     * @return string
     */
    public function getHouseNumberAddon()
    {
        return $this->houseNumberAddon;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Transform the creditor into an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'METADATA' => [
                'TABLE' => $this->table
            ],
            'DATA' => [
                'NR' => $this->getId(),
                'NAAM' => $this->getName(),
                'BNKIBAN' => $this->getBankAccount(),
                'VRIJVELD1' => $this->getUser(),
                'STRAAT' => $this->getStreet(),
                'HNR' => $this->getHouseNumber(),
                'HNRTV' => $this->getHouseNumberAddon(),
                'POSTCD' => $this->getPostcode(),
                'PLAATS' => $this->getCity()
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
