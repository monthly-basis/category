<?php
namespace MonthlyBasis\Category;

use MonthlyBasis\Category\Model\Db as CategoryDb;
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
                CategoryTable\Category::class => function ($sm) {
                    return new CategoryTable\Category(
                        $sm->get(CategoryDb\Sql::class)
                    );
                },
            ],
        ];
    }
}
