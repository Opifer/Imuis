<?php

namespace Opifer\Imuis\Tests\Response;

use Opifer\Imuis\Response\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testHasErrors()
    {
        $xmlResponse = new \SimpleXMLElement('<DATASET><ERROR><MESSAGE>Some error string</MESSAGE></ERROR></DATASET>');

        $response = new Response($xmlResponse);

        $this->assertTrue($response->hasErrors());
        $this->assertSame(['Some error string'], $response->getErrors());
    }

    public function testHasNoErrors()
    {
        $xmlResponse = new \SimpleXMLElement('<DATASET></DATASET>');

        $response = new Response($xmlResponse);

        $this->assertFalse($response->hasErrors());
        $this->assertSame([], $response->getErrors());
    }

    public function testGetDate()
    {
        $xmlResponse = new \SimpleXMLElement('<DATASET><DATA></DATA></DATASET>');

        $response = new Response($xmlResponse);

        $this->assertInternalType('array', $response->getData());
    }
}
