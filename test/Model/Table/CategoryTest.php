<?php
namespace MonthlyBasis\CategoryTest\Model\Table;

use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class CategoryTest extends TableTestCase
{
    protected function setup(): void
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTable('category');
        $this->setForeignKeyChecks(1);

        $this->categoryTable = new CategoryTable\Category(
            $this->getSql()
        );
    }

    public function test_getColumns()
    {
        $result = $this->categoryTable->select(
            columns: $this->categoryTable->getColumns(),
            limit: 1,
        );
        $this->assertEmpty($result);
    }

    public function test_insert()
    {
        $result = $this->categoryTable->insert(
            values: [
                'slug' => 'slug',
                'name' => 'Name',
            ],
        );
        $this->assertSame(
            1,
            $result->getAffectedRows()
        );
        $this->assertSame(
            '1',
            $result->getGeneratedValue()
        );
    }

    public function test_selectCategoryIdWhereMatchAgainst()
    {
        $result = $this->categoryTable->selectCategoryIdWhereMatchAgainst(
            'query'
        );
        $this->assertEmpty($result);
    }
}
