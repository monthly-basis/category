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
        $this->adapter = $sql->getAdapter();
    }

    public function getColumns(): array
    {
        return [
            'category_id',
            'slug',
            'name',
            'description',
            'image_rru',
            'question_count_cached',
            'created_datetime',
        ];
    }

    public function selectCategoryIdWhereMatchAgainst(
        string $query,
        int $limit = 10,
    ): Result {
        $sql = '
            SELECT `category_id` FROM (
                SELECT `category_id`
                     , `name`
                  FROM `category`
                 WHERE MATCH (`name`) AGAINST (?) > 1
                 ORDER
                    BY `question_count_cached` DESC
                 LIMIT ?
            ) AS `category`
            ORDER BY `name` ASC
                 ;
        ';
        $parameters = [
            $query,
            $limit,
        ];
        return $this->adapter->query($sql)->execute($parameters);
    }
}
