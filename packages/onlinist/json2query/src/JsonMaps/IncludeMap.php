<?php

namespace Onlinist\Json2query\JsonMaps;

use Onlinist\Json2query\JsonMaps\WhereMap;
use Onlinist\Json2query\JsonMaps\OrderMap;

class IncludeMap {

    /**
     * Relationship Name
     * @var string
     * @required
     */
    public $relation;

    /**
     * Select Clause
     * @var array
     */
    public $select;

    /**
     * Where Clause
     * @var WhereMap
     */
    public $where;

    /**
     * Order Clause
     * @var array[OrderMap]
     */
    public $order;

    /**
     * Include Relationships
     * @var array[IncludeMap]
     */
    public $include;

    /**
     * Include Relationships Count
     * @var array[IncludeCountMap]
     */
    public $include_count;

    /**
     * Scopes to add to query
     * @var array
     */
    public $scopes;

}

class IncludeCountMap {

    /**
     * Relationship Name
     * @var string
     * @required
     */
    public $relation;

    /**
     * Where Clause
     * @var WhereMap
     */
    public $where;

    /**
     * Scopes to add to query
     * @var array
     */
    public $scopes;

}
