<?php

namespace Onlinist\Json2query\JsonMaps;

use Onlinist\Json2query\JsonMaps\WhereMap;
use Onlinist\Json2query\JsonMaps\OrderMap;
use Onlinist\Json2query\JsonMaps\IncludeMap;
use Onlinist\Json2query\JsonMaps\IncludeCountMap;

class JsonMap {

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
