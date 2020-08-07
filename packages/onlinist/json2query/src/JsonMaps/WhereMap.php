<?php

namespace Onlinist\Json2query\JsonMaps;

trait WhereOrTrait {

    /**
     * OR Grouping
     * @var array[WhereMap]
     */
    public $or;

}

trait WhereAndTrait {

    /**
     * AND Grouping
     * @var array[WhereMap]
     */
    public $and;

}

trait WhereConditionTrait {

    /**
     * Field Name
     * @var string
     * @required
     */
    public $field;

    /**
     * Field Value
     * @var mixed|null
     */
    public $value;

    /**
     * Operator
     * @var string
     */
    public $operator = '=';

    /**
     * Sub Operator
     * @var string
     */
    public $sub_operator = '=';

}

trait WildcardConditionTrait {

    /**
     * Fields Name
     * @var array
     */
    public $fields;

    /**
     * Value
     * @var string
     */
    public $value;

}

trait WildcardTrait {

    /**
     * Wildcard Condition
     * @var WildcardConditionMap
     */
    public $wildcard;

}

class WhereOrMap {

    use WhereOrTrait;
}

class WhereAndMap {

    use WhereAndTrait;
}

class WhereConditionMap {

    use WhereConditionTrait;
}

class WildcardConditionMap {

    use WildcardConditionTrait;
}

class WildcardMap {

    use WildcardTrait;
}

class WhereMap {

    use WhereOrTrait;
    use WhereAndTrait;
    use WhereConditionTrait;
    use WildcardTrait;
}
