<?php

namespace Opifer\Imuis;

use Opifer\Imuis\Model\Creditor;
use Opifer\Imuis\Model\Journal;
use Opifer\Imuis\Criteria\Criteria;
use Opifer\Imuis\Response\Response;

/**
 * Imuis Client
 *
 * @author Rick van Laarhoven <r.vanlaarhoven@opifer.nl>
 */
class Client
{
    /** @var string */
    protected $partnerKey;
    
    /** @var string */
    protected $environment;
    
    /** @var string */
    protected $url;
    
    /** @var \GuzzleHttp\Client */
    protected $_client;
    
    /** @var string */
    protected $_session;

    /**
     * Constructor
     *
     * @param string $partnerKey
     * @param string $environment
     * @param string $url
     */
    public function __construct($partnerKey, $environment, $url = 'https://cloudswitch.imuisonline.com/ws1_api.aspx')
    {
        $this->partnerKey = $partnerKey;
        $this->environment = $environment;
        $this->url = $url;

        $this->initializeClient();
    }

    /**
     * Initialize the client
     */
    public function initializeClient()
    {
        $this->_client = new \GuzzleHttp\Client();
    }

    /**
     * Create Journal
     *
     * @param  Journal $journal
     *
     * @return Response
     */
    public function createJournal(Journal $journal)
    {
        $response = $this->call('CREATEJOURNAALPOST', 'JOURNAALPOST', $journal);

        if ($response->hasErrors()) {
            $errors = $response->getErrors();
            throw new \Exception($errors[0]);
        }

        return $response;
    }

    /**
     * Create creditor
     *
     * @param  Creditor $creditor
     *
     * @return integer
     */
    public function createCreditor(Creditor $creditor)
    {
        $response = $this->call('CREATESTAMTABELRECORD', 'STAMTABEL', $creditor);

        if ($response->hasErrors()) {
            $message = $response->getErrors();
            throw new \Exception($message[0]);
        }

        $response = $response->getData();

        return (int) $response['TABEL']->PRIMARYKEY;
    }

    /**
     * Find a creditor by its ID
     *
     * @param integer $id
     */
    public function findCreditor($id)
    {
        $criteria = new Criteria();

        $criteria->setTable('CRE');
        $criteria->setSelect('NAAM' . "\t" . 'BNKIBAN');
        $criteria->setWheres('NR');
        $criteria->setOperators('=');
        $criteria->setValues($id);
        $criteria->setOrderBy('NR');
        $criteria->setMaxResults(1);
        $criteria->setPageSize(20);
        $criteria->setPage(1);

        return $this->getResults($criteria);
    }

    /**
     * Get balance by creditor & invoice
     *
     * @param integer $creditorNo
     * @param integer $invoiceNo
     *
     * @return bool|float
     */
    public function getBalanceByInvoice($creditorNo, $invoiceNo)
    {
        $criteria = new Criteria();
        $criteria
            ->setTable('CREOPP')
            ->setSelect('SALDO')
            ->setWheres("FACT\tCRE")
            ->setOperators("=\t=")
            ->setValues(sprintf("%s\t%s", $invoiceNo, $creditorNo))
            ->setOrderBy('SALDO')
            ->setMaxResults(0)
            ->setPageSize(1)
            ->setPage(1);

        $response = $this->getResults($criteria);
        $data = json_decode(json_encode($response->getData()));

        return (isset($data->DATA->SALDO)) ? (float) $data->DATA->SALDO : false;
    }

    /**
     * Get results
     *
     * @param Criteria $criteria
     */
    public function getResults(Criteria $criteria)
    {
        return $this->call('GETSTAMTABELRECORDS', 'SELECTIE', $criteria);
    }

    /**
     * Logs in to the iMuis API and returns the session ID
     *
     * @return string
     */
    public function login()
    {
        $response = $this->_client->post($this->url, [
            'body' => [
                'ACTIE'         => 'LOGIN',
                'partnerkey'    => $this->partnerKey,
                'omgevingscode' => $this->environment
            ]
        ]);

        return (string) $response->xml()->SESSION->SESSIONID;
    }

    /**
     * Keep session
     *
     * @param  string $sessionId
     *
     * @return string
     */
    public function keepSession($sessionId)
    {
        $response = $this->_client->post($this->url, [
            'body' => [
                'ACTIE'         => 'KEEPSESSION',
                'partnerkey'    => $this->partnerKey,
                'omgevingscode' => $this->environment,
                'SESSIONID'     => $sessionId
            ]
        ]);

        return $response;
    }

    /**
     * Call the API
     *
     * @return Response
     */
    public function call($action, $definition, $criteria)
    {
        $response = $this->_client->post($this->url, [
            'body' => [
                'ACTIE'         => $action,
                'SESSIONID'     => $this->getSessionID(),
                'partnerkey'    => $this->partnerKey,
                'omgevingscode' => $this->environment,
                $definition     => $criteria->toXml()->asXML()
            ]
        ]);

        return new Response($response->xml());
    }

    /**
     * Get session ID
     *
     * @return string
     */
    public function getSessionID()
    {
        if (null === $this->_session) {
            $this->_session = $this->login();
        }

        return $this->_session;
    }

    /**
     * Get the client
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->_client;
    }
}
