<?php
namespace ClassResolverTest;

use ClassResolver\ClassResolverFactory;
use Zend\ServiceManager\ServiceManager;

/**
 * Class ClassResolverFactoryTest
 *
 * @package ClassResolverTest
 * @author Aeneas Rekkas
 */
class ClassResolverFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService(
            'Config',
            [
                'class_resolver' => [
                    'FooInterface' => 'Bar'
                ]
            ]
        );

        $factory       = new ClassResolverFactory();
        $classResolver = $factory->createService($serviceManager);

        $this->assertInstanceOf('ClassResolver\ClassResolver', $classResolver);
    }
}
