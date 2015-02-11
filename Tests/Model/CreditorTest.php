<?php

namespace Opifer\Imuis\Tests\Model;

use Opifer\Imuis\Model\Creditor;

class CreditorTest extends \PHPUnit_Framework_TestCase
{
    private $creditor;

    public function setUp()
    {
        $this->creditor = new Creditor();
        $this->creditor
            ->setId(1)
            ->setName('Jan Janssen')
            ->setBankAccount('NL54RABO0128529445')
            ->setUser(3)
            ->setStreet('Kalverstraat')
            ->setHouseNumber(123)
            ->setHouseNumberAddon('B')
            ->setPostcode('1234AB')
            ->setCity('Amsterdam');
    }

    public function testToArray()
    {
        $expected = [
            'METADATA' => [
                'TABLE' => 'CRE'
            ],
            'DATA' => [
                'NR' => 1,
                'NAAM' => 'Jan Janssen',
                'BNKIBAN' => 'NL54RABO0128529445',
                'VRIJVELD1' => 3,
                'STRAAT' => 'Kalverstraat',
                'HNR' => 123,
                'HNRTV' => 'B',
                'POSTCD' => '1234AB',
                'PLAATS' => 'Amsterdam'
            ]
        ];

        $actual = $this->creditor->toArray();

        $this->assertInternalType('array', $actual);
        $this->assertSame($expected, $actual);
    }

    public function testToXml()
    {
        $expected = new \SimpleXMLElement('<DATASET><METADATA><TABLE>CRE</TABLE></METADATA><DATA><NR>1</NR><NAAM>Jan Janssen</NAAM><BNKIBAN>NL54RABO0128529445</BNKIBAN><VRIJVELD1>3</VRIJVELD1><STRAAT>Kalverstraat</STRAAT><HNR>123</HNR><HNRTV>B</HNRTV><POSTCD>1234AB</POSTCD><PLAATS>Amsterdam</PLAATS></DATA></DATASET>');

        $actual = $this->creditor->toXml();

        $this->assertEquals($expected, $actual);
    }
}
