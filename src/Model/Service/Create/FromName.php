<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Create;

use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\String\Model\Service as StringService;

/**
 * Create category from name.
 *
 * If category already exists, return false.
 *
 * If category does not exist, create it and return true.
 */
class FromName
{
    public function __construct(
        protected CategoryTable\Category $categoryTable,
        protected StringService\UrlFriendly $urlFriendlyService,
    ) {}

    public function createFromName(string $name): bool
    {
        $result = $this->categoryTable->select(
            columns: [
                'category_id',
                'slug',
                'name',
            ],
            where: [
                'name' => $name,
            ],
        );
        if ($result->current() !== false) {
            return false;
        }

        $slug = $this->urlFriendlyService->getUrlFriendly($name);

        $this->categoryTable->insert([
            'slug' => $slug,
            'name' => $name,
        ]);

        return true;
    }
}
