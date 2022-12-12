<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\Model\Service\Url;

use MonthlyBasis\Category\Model\Service as CategoryService;

class FromName
{
    public function __construct(
        protected CategoryService\RootRelativeUrl\FromName $rruFromNameService
    ) {}

    public function getUrlFromName(
        string $name
    ): string {
        return 'https://'
             . $_SERVER['HTTP_HOST']
             . $this->rruFromNameService->getRootRelativeUrlFromName($name);
    }
}
