<?php
namespace MonthlyBasis\CategoryTest\Model\Service\RootRelativeUrl;

use Laminas\Db\Adapter\Driver\Pdo\Result;
use MonthlyBasis\LaminasTest\Hydrator as TestHydrator;
use MonthlyBasis\Category\Model\Service as CategoryService;
use MonthlyBasis\Category\Model\Table as CategoryTable;
use PHPUnit\Framework\TestCase;

class FromNameTest extends TestCase
{
    protected function setUp(): void
    {
        $this->categoryTableMock = $this->createMock(
            CategoryTable\Category::class
        );
        $this->fromNameService = new CategoryService\RootRelativeUrl\FromName(
            $this->categoryTableMock
        );
    }

    public function test_getRootRelativeUrlFromName_categoryExists_string()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $resultHydrator = new TestHydrator\CountableIterator();
        $resultHydrator->hydrate(
            $resultMock,
            [
                [
                    'slug' => 'category-slug',
                ],
            ],
        );

        $this->categoryTableMock
            ->expects($this->once())
            ->method('select')
            ->with(['slug'], null, ['name' => 'Category Name'])
            ->willReturn($resultMock)
        ;
        $this->assertSame(
            '/categories/category-slug',
            $this->fromNameService->getRootRelativeUrlFromName('Category Name'),
        );
    }

    public function test_getRootRelativeUrlFromName_categoryDoesNotExist_string()
    {
        $resultMock = $this->createMock(
            Result::class
        );
        $resultHydrator = new TestHydrator\CountableIterator();
        $resultHydrator->hydrate(
            $resultMock,
            [],
        );

        $this->categoryTableMock
            ->expects($this->once())
            ->method('select')
            ->with(['slug'], null, ['name' => 'Category Name'])
            ->willReturn($resultMock)
        ;
        $this->assertSame(
            '/categories?category=Category+Name',
            $this->fromNameService->getRootRelativeUrlFromName('Category Name'),
        );
    }
}
