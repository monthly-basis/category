<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Create;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Exception as CategoryException;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\String\Model\Service as StringService;

/**
 * Create category from name.
 *
 * Use slug, not name, to determine whether category already exists.
 * This is because 'Math', 'Math!', 'MATH', and 'Math ' all result in the same slug.
 *
 * Get slug from name.
 * If category slug already exists, return false.
 * If category slug does not exist, create it and return true.
 */
class FromName
{
    public function __construct(
        protected CategoryFactory\FromSlug $fromSlugFactory,
        protected CategoryTable\Category $categoryTable,
        protected StringService\UrlFriendly $urlFriendlyService,
    ) {}

    public function createFromName(string $name): CategoryEntity\Category|false
    {
        $slug = $this->urlFriendlyService->getUrlFriendly($name);

        try {
            return $this->fromSlugFactory->buildFromSlug($slug);
        } catch (CategoryException) {
            // Do nothing.
        }

        if (strlen($name) <= 64) {
            $this->categoryTable->insert([
                'slug' => $slug,
                'name' => $name,
            ]);
            return $this->fromSlugFactory->buildFromSlug($slug);
        }

        return false;
    }
}
