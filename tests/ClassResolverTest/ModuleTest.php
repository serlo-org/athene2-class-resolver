<?php

namespace ClassResolverTest;

use ClassResolver\Module;

/**
 * Class ModuleTest
 *
 * @package ClassResolverTest
 * @author  Aeneas Rekkas
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigIsArray()
    {
        $module = new Module();
        $this->assertInternalType('array', $module->getConfig());
    }

    public function testAutoloaderIsArray()
    {
        $module = new Module();
        $this->assertInternalType('array', $module->getAutoloaderConfig());
    }
}
