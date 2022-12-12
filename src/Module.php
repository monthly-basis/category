<?php
namespace MonthlyBasis\Category;

use MonthlyBasis\Category\Model\Db as CategoryDb;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use MonthlyBasis\Category\Model\Service as CategoryService;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use MonthlyBasis\Category\View\Helper as CategoryHelper;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                    'buildCategoryFromName' => CategoryHelper\Factory\FromName::class,
                ],
                'factories' => [
                    CategoryHelper\Factory\FromName::class => function ($sm) {
                        return new CategoryHelper\Factory\FromName(
                            $sm->get(CategoryFactory\FromName::class),
                        );
                    }
                ],
            ],
        ];
    }

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
                CategoryFactory\FromName::class => function ($sm) {
                    return new CategoryFactory\FromName(
                        $sm->get(CategoryFactory\FromArray::class),
                        $sm->get(CategoryTable\Category::class),
                    );
                },
                CategoryFactory\FromSlug::class => function ($sm) {
                    return new CategoryFactory\FromSlug(
                        $sm->get(CategoryFactory\FromArray::class),
                        $sm->get(CategoryTable\Category::class),
                    );
                },
                CategoryService\Categories\ChildCategories::class => function ($sm) {
                    return new CategoryService\Categories\ChildCategories(
                        $sm->get(CategoryFactory\FromCategoryId::class),
                        $sm->get(CategoryTable\CategoryParentChild::class),
                    );
                },
                CategoryService\Categories\ParentCategories::class => function ($sm) {
                    return new CategoryService\Categories\ParentCategories(
                        $sm->get(CategoryFactory\FromCategoryId::class),
                        $sm->get(CategoryTable\CategoryParentChild::class),
                    );
                },
                CategoryService\RootRelativeUrl\FromName::class => function ($sm) {
                    return new CategoryService\RootRelativeUrl\FromName(
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
