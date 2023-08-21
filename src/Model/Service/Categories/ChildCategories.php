<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Categories;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use Generator;

class ChildCategories
{
    public function __construct(
        protected CategoryFactory\FromCategoryId $fromCategoryIdFactory,
        protected CategoryTable\CategoryParentChild $categoryParentChildTable,
    ) {}

    public function getChildCategories(
        CategoryEntity\Category $categoryEntity
    ): Generator {
        $result = $this->categoryParentChildTable->selectChildIdWhereParentId(
            $categoryEntity->categoryId
        );
        foreach ($result as $array) {
            yield $this->fromCategoryIdFactory->buildFromCategoryId(
                $array['child_id']
            );
        }
    }
}
