<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Categories\ChildCategories;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;

class Count
{
    public function __construct(
        protected CategoryTable\CategoryParentChild $categoryParentChildTable,
    ) {}

    public function getCount(
        CategoryEntity\Category $categoryEntity
    ): int {
        $result = $this->categoryParentChildTable->selectCountWhereParentId(
            $categoryEntity->categoryId
        );
        return intval($result->current()['COUNT(*)']);
    }
}
