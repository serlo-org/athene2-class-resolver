<?php
namespace ClassResolverTest;

use ClassResolverTest\Fake\ClassResolverAware;

/**
 * Class ClassResolverAwareTraitTest
 *
 * @package ClassResolverTest
 * @author Aeneas Rekkas
 */
class ClassResolverAwareTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ClassResolverAware
     */
    protected $trait;

    public function setUp()
    {
        $this->trait = new ClassResolverAware();
    }

    public function testSetGet()
    {
        $mock = $this->getMock('ClassResolver\ClassResolver', [], [], '', false);
        $this->trait->setClassResolver($mock);
        $this->assertSame($mock, $this->trait->getClassResolver());
    }
}
