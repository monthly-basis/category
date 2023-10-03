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
}
