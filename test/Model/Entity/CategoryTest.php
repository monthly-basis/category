<?php
namespace MonthlyBasis\CategoryTest\Model\Entity;

use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    protected function setUp(): void
    {
        $this->categoryEntity = new CategoryEntity\Category();
    }

    public function test___isset()
    {
        $this->assertFalse(
            isset($this->categoryEntity->name)
        );

        $this->categoryEntity->name = 'Name';

        $this->assertTrue(
            isset($this->categoryEntity->name)
        );
    }

    public function test_settersAndGetters()
    {
        $categoryId = 1234;
        $this->assertSame(
            $this->categoryEntity,
            $this->categoryEntity->setCategoryId(1234)
        );
        $this->assertSame(
            $categoryId,
            $this->categoryEntity->getCategoryId()
        );
    }
}
