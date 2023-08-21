<?php
namespace MonthlyBasis\CategoryTest\Model\Table;

use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class CategoryParentChildTest extends TableTestCase
{
    protected function setup(): void
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTable('category_parent_child');
        $this->setForeignKeyChecks(1);

        $this->categoryParentChildTable = new CategoryTable\CategoryParentChild(
            $this->getSql()
        );
    }

    public function test_selectChildIdNameWhereParentIdLimit()
    {
        $result = $this->categoryParentChildTable->selectChildIdNameWhereParentIdLimit(
            12345,
            0,
            10
        );
        $this->assertEmpty($result);
    }

    public function test_selectCountWhereParentId()
    {
        $result = $this->categoryParentChildTable->selectCountWhereParentId(
            1
        );
        $this->assertSame(
            0,
            $result->current()['COUNT(*)'],
        );
    }
}
