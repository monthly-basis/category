<?php

declare(strict_types=1);

namespace MonthlyBasis\Category\View\Helper\Factory;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\Category\Model\Entity as CategoryEntity;
use MonthlyBasis\Category\Model\Exception as CategoryException;
use MonthlyBasis\Category\Model\Factory as CategoryFactory;

class FromName extends AbstractHelper
{
    public function __construct(
        protected CategoryFactory\FromName $fromNameFactory,
    ) {}

    /**
     * throws CategoryException
     */
    public function __invoke(
        string $name
    ): CategoryEntity\Category {
        return $this->fromNameFactory->buildFromName($name);
    }
}
