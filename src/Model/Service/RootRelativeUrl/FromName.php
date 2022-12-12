<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\RootRelativeUrl;

use MonthlyBasis\Category\Model\Table as CategoryTable;

class FromName
{
    public function __construct(
        protected CategoryTable\Category $categoryTable
    ) {}

    public function getRootRelativeUrlFromName(
        string $name
    ): string {
        $result = $this->categoryTable->select(
            columns: [
                'slug',
            ],
            where: [
                'name' => $name,
            ],
        );

        $current = $result->current();

        if ($current === false) {
            return '/categories?category=' . urlencode($name);
        }

        return '/categories/' . urlencode($current['slug']);
    }
}
