<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Categories\ChildCategories;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\Memcached\Model\Service as MemcachedService;

class Count
{
    public function __construct(
        protected CategoryTable\CategoryParentChild $categoryParentChildTable,
        protected MemcachedService\Memcached $memcachedService
    ) {}

    /**
     * Category entity may change frequently, such as by incrementing its views.
     * So the serialized category entity cannot be used as a reliable cache key.
     * Therefore a separate protected method ::getCountFromCategoryId
     * is used instead.
     */
    public function getCount(
        CategoryEntity\Category $categoryEntity
    ): int {
        return $this->getCountFromCategoryId(
            $categoryEntity->categoryId
        );
    }

    protected function getCountFromCategoryId(
        int $categoryId
    ): int {
        $memcachedKey = md5(__METHOD__ . serialize(func_get_args()));
        if (null !== ($count = $this->memcachedService->get($memcachedKey))) {
            return $count;
        }

        $result = $this->categoryParentChildTable->selectCountWhereParentId(
            $categoryId
        );
        $count = intval($result->current()['COUNT(*)']);

        $this->memcachedService->setForDays(
            $memcachedKey,
            $count,
            1
        );
        return $count;
    }
}
