<?php
namespace MonthlyBasis\CategoryTest\Model\Service\Categories;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Service as CategoryService;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\LaminasTest\TableTestCase;

class SearchTest extends TableTestCase
{
    protected function setup(): void
    {
        $this->setForeignKeyChecks(0);
        $this->dropAndCreateTables([
            'category',
        ]);
        $this->setForeignKeyChecks(1);

        $this->fromCategoryIdFactoryMock = $this->createMock(
            CategoryFactory\FromCategoryId::class
        );
        $this->categoryTableMock = $this->createMock(
            CategoryTable\Category::class
        );

        $this->searchService = new CategoryService\Categories\Search(
            $this->fromCategoryIdFactoryMock,
            $this->categoryTableMock,
        );
    }

    public function test_search()
    {
        $categoriesGenerator = $this->searchService->search('query');
        $this->assertEmpty(iterator_to_array($categoriesGenerator));
    }
}
