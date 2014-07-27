<?php
namespace ClassResolver;

/**
 * Interface ClassResolverInterface
 *
 * @package ClassResolver
 * @author Aeneas Rekkas
 */
interface ClassResolverInterface
{

    /**
     * @param string $class
     * @return string class name
     */
    public function resolveClassName($class);

    /**
     * @param string $class
     * @param bool   $userServiceLocator
     * @return object
     */
    public function resolve($class, $userServiceLocator = false);
}
