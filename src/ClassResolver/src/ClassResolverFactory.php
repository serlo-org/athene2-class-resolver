<?php
namespace ClassResolver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ClassResolverFactory
 *
 * @package ClassResolver
 * @author  Aeneas Rekkas
 */
class ClassResolverFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config   = $serviceLocator->get('config')['class_resolver'];
        $instance = new ClassResolver($serviceLocator, $config);

        return $instance;
    }
}
