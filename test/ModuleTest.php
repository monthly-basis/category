<?php
namespace MonthlyBasis\CategoryTest;

use MonthlyBasis\Category\Module;
use MonthlyBasis\LaminasTest\ModuleTestCase;

class ModuleTest extends ModuleTestCase
{
    protected function setUp(): void
    {
        $this->module = new Module();
    }
}
