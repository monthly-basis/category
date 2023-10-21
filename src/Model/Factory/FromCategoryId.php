<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Factory;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Exception as CategoryException;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;

class FromCategoryId
{
    protected array $cache;

    public function __construct(
        protected CategoryFactory\FromArray $fromArrayFactory,
        protected CategoryTable\Category $categoryTable
    ) {}

    /**
     * throws CategoryException
     */
    public function buildFromCategoryId(
        int $categoryId
    ): CategoryEntity\Category {
        if (isset($this->cache[$categoryId])) {
            return $this->cache[$categoryId];
        }

        $result = $this->categoryTable->select(
            columns: $this->categoryTable->getColumns(),
            where: [
                'category_id' => $categoryId,
            ],
        );

        if ($result->current() === false) {
            throw new CategoryException('Category with category ID does not exist.');
        }

        $categoryEntity = $this->fromArrayFactory->buildFromArray(
            $result->current()
        );
        $this->cache[$categoryId] = $categoryEntity;
        return $categoryEntity;
    }
}
