<?php

namespace Opifer\Imuis\Criteria;

/**
 * Criteria
 *
 * @author Rick van Laarhoven <r.vanlaarhoven@opifer.nl>
 */
class Criteria
{
    /**
     * Table
     *
     * @var string
     */
    protected $table;

    /**
     * Select fields
     *
     * @var string
     */
    protected $select;

    /**
     * Where fields
     *
     * @var string
     */
    protected $wheres;

    /**
     * Operator
     *
     * @var string
     */
    protected $operators;

    /**
     * Value
     *
     * @var string
     */
    protected $values;

    /**
     * Max results
     *
     * @var integer
     */
    protected $maxResults;

    /**
     * Order by
     *
     * @var string
     */
    protected $orderBy;

    /**
     * Page size
     *
     * @var integer
     */
    protected $pageSize;

    /**
     * Page
     *
     * @var integer
     */
    protected $page;

    /**
     * Set table
     *
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set Select
     *
     * @param string $select
     */
    public function setSelect($select)
    {
        $this->select = $select;

        return $this;
    }

    /**
     * Get select
     *
     * @return string
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Set wheres
     *
     * @param string $wheres
     */
    public function setWheres($wheres)
    {
        $this->wheres = $wheres;

        return $this;
    }

    /**
     * Get wheres
     *
     * @return string
     */
    public function getWheres()
    {
        return $this->wheres;
    }

    /**
     * Set operators
     *
     * @param string $operators
     */
    public function setOperators($operators)
    {
        $this->operators = $operators;

        return $this;
    }

    /**
     * Get operators
     *
     * @return string
     */
    public function getOperators()
    {
        return $this->operators;
    }

    /**
     * Set values
     *
     * @param string $values
     */
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Get values
     *
     * @return string
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set order by
     *
     * @param string $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get order by
     *
     * @return string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set max results
     *
     * @param integer $maxResults
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;

        return $this;
    }

    /**
     * Get max results
     *
     * @return integer
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }

    /**
     * Set page size
     *
     * @param integer $pageSize
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * Get page size
     *
     * @return integer
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * Set page
     *
     * @param integer $page
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Transform the object to an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'TABLE' => $this->getTable(),
            'SELECTFIELDS' => $this->getSelect(),
            'WHEREFIELDS' => $this->getWheres(),
            'WHEREOPERATORS' => $this->getOperators(),
            'WHEREVALUES' => $this->getValues(),
            'ORDERBY' => $this->getOrderBy(),
            'MAXRESULT' => $this->getMaxResults(),
            'PAGESIZE' => $this->getPageSize(),
            'SELECTPAGE' => $this->getPage()
        ];
    }

    /**
    * Transform the object to an XML Element
    *
    * @return \SimpleXMLElement
    */
    public function toXml()
    {
        $xml = new \SimpleXMLElement('<DATASET></DATASET>');
        $array = $this->toArray();

        foreach ($array as $key => $value) {
            $xml->addChild($key, $value);
        }

        return $xml;
    }
}
