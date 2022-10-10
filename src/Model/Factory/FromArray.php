<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Factory;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;

class FromArray
{
    public function buildFromArray(
        array $array
    ): CategoryEntity\Category {
        return (new CategoryEntity\Category())
            ->setCategoryId($array['category_id'])
            ->setName($array['name'])
            ->setSlug($array['slug'])
            ;
    }
}
