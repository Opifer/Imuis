<?php

namespace Opifer\Imuis\Tests\Criteria;

use Opifer\Imuis\Criteria\Criteria;

class CriteriaTest extends \PHPUnit_Framework_TestCase
{
    private $criteria;

    public function setUp()
    {
        $this->criteria = new Criteria();
        $this->criteria
            ->setTable('CREOPP')
            ->setSelect('SALDO')
            ->setWheres("FACT\tCRE")
            ->setOperators("=\t=")
            ->setValues(sprintf("%s\t%s", 123, 456))
            ->setOrderBy('SALDO')
            ->setMaxResults(0)
            ->setPageSize(1)
            ->setPage(1);
    }

    public function testToArray()
    {
        $expected = [
            'TABLE' => 'CREOPP',
            'SELECTFIELDS' => 'SALDO',
            'WHEREFIELDS' => "FACT\tCRE",
            'WHEREOPERATORS' => "=\t=",
            'WHEREVALUES' => "123\t456",
            'ORDERBY' => 'SALDO',
            'MAXRESULT' => 0,
            'PAGESIZE' => 1,
            'SELECTPAGE' => 1
        ];

        $actual = $this->criteria->toArray();

        $this->assertInternalType('array', $actual);
        $this->assertSame($expected, $actual);
    }

    public function testToXml()
    {
        $expected = new \SimpleXMLElement("<DATASET><TABLE>CREOPP</TABLE><SELECTFIELDS>SALDO</SELECTFIELDS><WHEREFIELDS>FACT\tCRE</WHEREFIELDS><WHEREOPERATORS>=\t=</WHEREOPERATORS><WHEREVALUES>123\t456</WHEREVALUES><ORDERBY>SALDO</ORDERBY><MAXRESULT>0</MAXRESULT><PAGESIZE>1</PAGESIZE><SELECTPAGE>1</SELECTPAGE></DATASET>");

        $actual = $this->criteria->toXml();

        $this->assertEquals($expected, $actual);
    }
}