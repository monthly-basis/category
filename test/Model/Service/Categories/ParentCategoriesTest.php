<?php
namespace MonthlyBasis\CategoryTest\Model\Service\Categories;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Service as CategoryService;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class ParentCategoriesTest extends TableTestCase
{
    protected function setup(): void
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTables([
            'category',
            'category_parent_child',
        ]);
        $this->setForeignKeyChecks(1);

        $this->fromCategoryIdMock = $this->createMock(
            CategoryFactory\FromCategoryId::class
        );
        $this->categoryParentChildTable = new CategoryTable\CategoryParentChild(
            $this->getSql()
        );

        $this->parentCategoriesService = new CategoryService\Categories\ParentCategories(
            $this->fromCategoryIdMock,
            $this->categoryParentChildTable,
        );
    }

    public function test_getParentCategories()
    {
        $categoryEntity = new CategoryEntity\Category();
        $categoryEntity->categoryId = 123;

        $parentCategoriesGenerator = $this->parentCategoriesService->getParentCategories(
            $categoryEntity
        );

        $this->assertEmpty(
            iterator_to_array($parentCategoriesGenerator)
        );
    }
}
