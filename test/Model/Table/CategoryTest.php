<?php
namespace MonthlyBasis\CategoryTest\Model\Table;

use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class CategoryTest extends TableTestCase
{
    protected function setup(): void
    {
        $this->dropAndCreateTable('category');

        $this->categoryTable = new CategoryTable\Category(
            $this->getSql()
        );
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
}
