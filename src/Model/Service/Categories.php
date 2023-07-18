<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use Generator;

class Categories
{
    public function __construct(
        protected CategoryFactory\FromArray $fromArrayFactory,
        protected CategoryTable\Category $categoryTable,
    ) {}

    public function getCategories(): Generator
    {
        $result = $this->categoryTable->select(
            columns: [
                'category_id',
                'slug',
                'name',
            ],
            order: [
                'name ASC',
            ],
        );
        foreach ($result as $array) {
            yield $this->fromArrayFactory->buildFromArray(
                $array
            );
        }
    }
}
