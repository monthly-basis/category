<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Table;

use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\Driver\Pdo\Result;
use MonthlyBasis\Laminas\Model\Db as LaminasDb;

class CategoryParentChild extends LaminasDb\Table
{
    protected Adapter $adapter;
    protected string $table = 'category_parent_child';

    public function __construct(
        protected \Laminas\Db\Sql\Sql $sql,
    ) {
        $this->adapter = $sql->getAdapter();
    }

    public function selectCountWhereParentId(int $parentId): Result
    {
        $sql = '
            SELECT COUNT(*)
              FROM `category_parent_child`
             WHERE `category_parent_child`.`parent_id` = ?
                 ;
        ';
        $parameters = [
            $parentId,
        ];
        return $this->adapter->query($sql)->execute($parameters);
    }
}
