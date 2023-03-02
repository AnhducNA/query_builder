<?php

namespace Anhduc\QueryBuilder\Query;

class SqlClauses
{
    /**
     * Select clause parameters.
     *
     * @var array
     */
    protected array $select = [];

    /**
     * From clause parameters.
     *
     * @var array
     */
    protected array $from = [];

    /**
     * Where clause parameters.
     *
     * @var array
     */
    protected array $where = [];

    /**
     * Group By clause parameters.
     *
     * @var array
     */
    protected array $groupBy = [];

    /**
     * Having clause parameters.
     *
     * @var array
     */
    protected array $having = [];

    /**
     * Order By clause parameters.
     *
     * @var array
     */
    protected array $orderBy = [];

    /**
     * Limit Clause parameters.
     *
     * @var integer
     */
    protected int $limit;

    /**
     * Offset clause parameters.
     *
     * @var integer
     */
    protected int $offset;

    /**
     * Apply select clause.
     *
     * @param mixed $fields
     * @return $this
     */
    public function select($fields = ['*'])
    {
        $fields = is_array($fields) ? $fields : func_get_args();
        foreach ($fields as $key => $field) {
            $fields[$key] = $this->identifierOf($field);
        }

        $this->select = array_merge($this->select, $fields);
dd($this->select());
        return $this;
    }

    /**
     * Apply from clause.
     *
     * @param mixed $tables
     * @return $this
     */
    public function table($tables)
    {
        dd($tables);
        $tables = is_array($tables) ? $tables : func_get_args();

        $this->addTable($tables);

        return $this;
    }

    /**
     * Apply where clause.
     *
     * @param array $params
     * @return $this
     */
    public function where(...$params)
    {
        return $this->andWhere(...$params);
    }

    /**
     * Apply where clause with and.
     *
     * @param array $params
     * @return $this
     */
    public function andWhere(...$params)
    {
        return $this->whereLogicOperator('and', ...$params);
    }

    /**
     * Apply where clause with or.
     *
     * @param array $params
     * @return $this
     */
    public function orWhere(...$params)
    {
        return $this->whereLogicOperator('or', ...$params);
    }
    public function all()
    {
        $sql = $this->getCompiledSelectStatement();
dd($sql);
        return $this->connection->query($sql)->fetchAll($this->fetchType);
    }
}