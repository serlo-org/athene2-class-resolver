<?php
namespace ClassResolver;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ClassResolverFactoryTrait
 *
 * @package ClassResolver
 * @author Aeneas Rekkas
 */
trait ClassResolverFactoryTrait
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return ClassResolver
     */
    protected function getClassResolver(ServiceLocatorInterface $serviceLocator)
    {
        return $serviceLocator->get('ClassResolver\ClassResolver');
    }
}
