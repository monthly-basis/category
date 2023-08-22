<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;

/**
 * Parent is a reserved word, so the class name must be ParentCategory
 */
class ParentCategory
{
    public function __construct(
        protected CategoryFactory\FromCategoryId $fromCategoryIdFactory,
        protected CategoryTable\CategoryParentChild $categoryParentChildTable,
    ) {}

    public function getParentCategory(
        CategoryEntity\Category $categoryEntity
    ): CategoryEntity\Category|null {
        $result = $this->categoryParentChildTable->select(
            columns: [
                'parent_id',
            ],
            joinArguments: [
                'category',
                'category.category_id = category_parent_child.parent_id',
            ],
            where: [
                'child_id' => $categoryEntity->categoryId
            ],
            order: [
                'category.question_count_cached DESC',
                'category.name ASC',
            ],
            limit: 1,
        );

        if ($result->current() === false) {
            return null;
        }

        return $this->fromCategoryIdFactory->buildFromCategoryId(
            $result->current()['parent_id']
        );
    }
}
