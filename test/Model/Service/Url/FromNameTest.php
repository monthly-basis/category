<?php
namespace MonthlyBasis\CategoryTest\Model\Service\Url;

use MonthlyBasis\Category\Model\Service as CategoryService;
use PHPUnit\Framework\TestCase;

class FromNameTest extends TestCase
{
    protected function setUp(): void
    {
        $this->rruFromNameServiceMock = $this->createMock(
            CategoryService\RootRelativeUrl\FromName::class
        );
        $this->urlFromNameService = new CategoryService\Url\FromName(
            $this->rruFromNameServiceMock
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function test_getUrlFromName_string()
    {
        $_SERVER = [
            'HTTP_HOST' => 'www.example.com',
        ];

        $this->rruFromNameServiceMock
            ->expects($this->once())
            ->method('getRootRelativeUrlFromName')
            ->with('Category Name')
            ->willReturn('/categories/category-slug')
        ;
        $this->assertSame(
            'https://www.example.com/categories/category-slug',
            $this->urlFromNameService->getUrlFromName('Category Name'),
        );
    }
}
