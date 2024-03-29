<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Factory;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;

class FromArray
{
    public function buildFromArray(
        array $array
    ): CategoryEntity\Category {
        $categoryEntity = (new CategoryEntity\Category())
            ->setCategoryId($array['category_id'])
            ->setName($array['name'])
            ->setSlug($array['slug'])
            ;

        if (isset($array['active'])) {
            $categoryEntity->active = boolval($array['active']);
        }

        if (isset($array['description'])) {
            $categoryEntity->description = $array['description'];
        }
        if (isset($array['image_rru'])) {
            $categoryEntity->imageRru = $array['image_rru'];
        }
        if (isset($array['question_count_cached'])) {
            $categoryEntity->questionCountCached = $array['question_count_cached'];
        }

        return $categoryEntity;
    }
}
