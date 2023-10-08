<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Categories;

use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use Generator;

class Search
{
    public function __construct(
        protected CategoryFactory\FromCategoryId $fromCategoryIdFactory,
        protected CategoryTable\Category $categoryTable,
    ) {}

    public function search(string $query, int $limitRowCount = 10): Generator
    {
        $result = $this->categoryTable->selectCategoryIdWhereMatchAgainst(
            $query,
            $limitRowCount,
        );
        foreach ($result as $array) {
            yield $this->fromCategoryIdFactory->buildFromCategoryId(
                $array['category_id']
            );
        }
    }
}
