<?php
namespace ClassResolverTest;

use ClassResolver\ClassResolver;
use ClassResolverTest\Fake\Foo;
use Zend\ServiceManager\ServiceManager;

/**
 * Class ClassResolverTest
 *
 * @package ClassResolverTest
 * @author Aeneas Rekkas
 */
class ClassResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassResolver
     */
    protected $classResolver;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function setUp()
    {
        parent::setUp();
        $this->serviceManager = new ServiceManager();
        $this->classResolver  = new ClassResolver($this->serviceManager, [
            'ClassResolverTest\Fake\FailInterface'      => 'ClassResolverTest\Fake\Foo',
            'ClassResolverTest\Fake\FooInterface'       => 'ClassResolverTest\Fake\Foo',
            'ClassResolverTest\Fake\BarInterface'       => 'ClassResolverTest\Fake\Bar',
            'ClassResolverTest\Fake\SuperFailInterface' => 'ClassResolverTest\Fake\SuperFail',
        ]);
    }

    public function testResolveClassName()
    {
        $this->assertEquals(
            'ClassResolverTest\Fake\Foo',
            $this->classResolver->resolveClassName('ClassResolverTest\Fake\FooInterface')
        );
        $this->assertEquals(
            'ClassResolverTest\Fake\Bar',
            $this->classResolver->resolveClassName('ClassResolverTest\Fake\BarInterface')
        );
    }

    public function testResolve()
    {
        $this->assertInstanceOf(
            'ClassResolverTest\Fake\FooInterface',
            $this->classResolver->resolve('ClassResolverTest\Fake\FooInterface')
        );
        $this->assertNotSame(
            $this->classResolver->resolve('ClassResolverTest\Fake\FooInterface'),
            $this->classResolver->resolve('ClassResolverTest\Fake\FooInterface')
        );
    }

    public function testResolveFromServiceManager()
    {
        $service = new Foo();

        $this->serviceManager->setService('ClassResolverTest\Fake\Foo', $service);
        $this->assertSame($service, $this->classResolver->resolve('ClassResolverTest\Fake\FooInterface', true));
    }

    /**
     * @expectedException \ClassResolver\Exception\RuntimeException
     */
    public function testResolveException()
    {
        $this->classResolver->resolve('ClassResolverTest\Fake\FailInterface');
    }

    /**
     * @expectedException \ClassResolver\Exception\InvalidArgumentException
     */
    public function testInvalidArgumentException()
    {
        $this->classResolver->resolveClassName([]);
    }

    /**
     * @expectedException \ClassResolver\Exception\RuntimeException
     */
    public function testClassNotFound()
    {
        $this->classResolver->resolveClassName('ClassResolverTest\Fake\SuperFailInterface');
    }

    /**
     * @expectedException \ClassResolver\Exception\RuntimeException
     */
    public function testNotResolvable()
    {
        $this->classResolver->resolveClassName('NotResolvable');
    }
}
