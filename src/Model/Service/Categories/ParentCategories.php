<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Categories;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use Generator;

/**
 * Parent is a reserved word, so the class name must be ParentCategories
 */
class ParentCategories
{
    public function __construct(
        protected CategoryFactory\FromCategoryId $fromCategoryIdFactory,
        protected CategoryTable\CategoryParentChild $categoryParentChildTable,
    ) {}

    public function getParentCategories(
        CategoryEntity\Category $categoryEntity
    ): Generator {
        $result = $this->categoryParentChildTable->select(
            where: [
                'child_id' => $categoryEntity->getCategoryId()
            ]
        );
        foreach ($result as $array) {
            yield $this->fromCategoryIdFactory->buildFromCategoryId(
                $array['parent_id']
            );
        }
    }
}
