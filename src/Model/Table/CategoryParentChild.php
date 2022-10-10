<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Table;

use MonthlyBasis\Laminas\Model\Db as LaminasDb;

class CategoryParentChild extends LaminasDb\Table
{
    protected string $table = 'category_parent_child';

    public function __construct(
        protected \Laminas\Db\Sql\Sql $sql,
    ) {
    }
}
