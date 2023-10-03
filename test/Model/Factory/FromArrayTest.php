<?php
namespace MonthlyBasis\CategoryTest\Model\Factory;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;
use PHPUnit\Framework\TestCase;

class FromArrayTest extends TestCase
{
    protected function setUp(): void
    {
        $this->fromArrayFactory = new CategoryFactory\FromArray();
    }

    public function test_buildFromArray()
    {
        $array = [
            'category_id'           => 123,
            'name'                  => 'name',
            'question_count_cached' => 456,
            'slug'                  => 'slug',
        ];
        $categoryEntity = new CategoryEntity\Category();
        $categoryEntity->categoryId          = 123;
        $categoryEntity->name                = 'name';
        $categoryEntity->questionCountCached = 456;
        $categoryEntity->slug                = 'slug';

        $this->assertEquals(
            $categoryEntity,
            $this->fromArrayFactory->buildFromArray($array)
        );
    }
}
