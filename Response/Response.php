<?php

namespace Opifer\Imuis\Response;

/**
 * Imuis XML Response
 *
 * @author Rick van Laarhoven <r.vanlaarhoven@opifer.nl>
 */
class Response
{
    protected $_response;

    /**
     * Constructor
     *
     * @param \SimpleXMLElement $response
     */
    public function __construct(\SimpleXMLElement $response)
    {
        $this->_response = $response;
    }

    /**
     * Check if the response has errors
     *
     * @return boolean
     */
    public function hasErrors()
    {
        if (isset($this->_response->ERROR)) {
            return true;
        }

        return false;
    }

    /**
     * Get the errors
     *
     * @return array
     */
    public function getErrors()
    {
        if (isset($this->_response->ERROR)) {
            $message = (string) $this->_response->ERROR->MESSAGE;

            return [$message];
        }

        return [];
    }

    /**
     * Get the data as an array
     *
     * @return array
     */
    public function getData()
    {
        return (array) $this->_response;
    }
}
