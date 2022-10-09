<?php
namespace MonthlyBasis\Category;

use MonthlyBasis\Category\Model\Db as CategoryDb;

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
                }
            ],
        ];
    }
}
