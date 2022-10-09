<?php
namespace MonthlyBasis\Category\Model\Table;

use Application\Model\Db as ApplicationDb;
use Laminas\Db\Adapter\Driver\Pdo\Result;
use MonthlyBasis\Laminas\Model\Db as LaminasDb;

class Category extends LaminasDb\Table
{
    protected string $table = 'category';

    public function __construct(
        protected \Laminas\Db\Sql\Sql $sql
    ) {
    }
}
