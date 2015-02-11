<?php

namespace Opifer\Imuis\Tests\Model;

use Opifer\Imuis\Model\Journal;

class JournalTest extends \PHPUnit_Framework_TestCase
{
    private $journal;

    public function setUp()
    {
        $this->journal = new Journal();
        $this->journal
            ->setJournal(20)
            ->setContraAccount(2090)
            ->setTaxCode(9)
            ->setDate(new \DateTime('10-01-2015'))
            ->setPeriod('January')
            ->setExternalInvoice(1)
            ->setAccount('NL54RABO0128529445')
            ->setContraAccount('NL54RABO0128529111')
            ->setInvoice(1234)
            ->setAmount(123.45)
            ->setTaxCode('EUR')
            ->setTaxAmount(12.05)
            ->setComment('Transaction of €123.45')
            ->setDescription('Transaction of €123.45');
    }

    public function testToArray()
    {
        $expected = [
            'BOE' => [
                'JR' => '2015',
                'PN' => 'January',
                'DAGB' => 20,
                'REK' => 'NL54RABO0128529445',
                'TEGREK' => 'NL54RABO0128529111',
                'FACT' => 1234,
                'BTW' => 'EUR',
                'BEDRBOEK' => 123.45,
                'DAT' => '10-01-2015',
                'OPM' => 'Transaction of €123.45',
                'BEDRBTW' => 12.05,
                'OMSCHR' => 'Transaction of €123.45',
                'BOEKSTUK' => 1
            ]
        ];

        $actual = $this->journal->toArray();

        $this->assertInternalType('array', $actual);
        $this->assertSame($expected, $actual);
    }

    public function testToXml()
    {
        $expected = new \SimpleXMLElement('<DATASET><BOE><JR>2015</JR><PN>January</PN><DAGB>20</DAGB><REK>NL54RABO0128529445</REK><TEGREK>NL54RABO0128529111</TEGREK><FACT>1234</FACT><BTW>EUR</BTW><BEDRBOEK>123.45</BEDRBOEK><DAT>10-01-2015</DAT><OPM>Transaction of €123.45</OPM><BEDRBTW>12.05</BEDRBTW><OMSCHR>Transaction of €123.45</OMSCHR><BOEKSTUK>1</BOEKSTUK></BOE></DATASET>');

        $actual = $this->journal->toXml();

        $this->assertEquals($expected, $actual);
    }
}
