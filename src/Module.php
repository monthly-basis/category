<?php
namespace MonthlyBasis\Category;

use MonthlyBasis\Category\Model\Db as CategoryDb;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Table as CategoryTable;

class Module
{
    public function getServiceConfig()
    {
        return [
            'factories' => [
                CategoryDb\Sql::class => function ($sm) {
                    return new CategoryDb\Sql(
                        $sm->get('category')
                    );
                },
                CategoryFactory\FromCategoryId::class => function ($sm) {
                    return new CategoryFactory\FromCategoryId(
                        $sm->get(CategoryFactory\FromArray::class),
                        $sm->get(CategoryTable\Category::class),
                    );
                },
                CategoryFactory\FromArray::class => function ($sm) {
                    return new CategoryFactory\FromArray();
                },
                CategoryFactory\FromSlug::class => function ($sm) {
                    return new CategoryFactory\FromSlug(
                        $sm->get(CategoryFactory\FromArray::class),
                        $sm->get(CategoryTable\Category::class),
                    );
                },
                CategoryTable\Category::class => function ($sm) {
                    return new CategoryTable\Category(
                        $sm->get(CategoryDb\Sql::class)
                    );
                },
                CategoryTable\CategoryParentChild::class => function ($sm) {
                    return new CategoryTable\CategoryParentChild(
                        $sm->get(CategoryDb\Sql::class)
                    );
                },
            ],
        ];
    }
}
