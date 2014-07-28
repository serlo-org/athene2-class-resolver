<?php
namespace ClassResolver;

/**
 * Interface ClassResolverInterface
 *
 * @package ClassResolver
 * @author  Aeneas Rekkas
 */
interface ClassResolverInterface
{

    /**
     * Resolves an interfaces name to a class name
     *
     * @param string $interface
     * @return string class name
     */
    public function resolveClassName($interface);

    /**
     * Resolves an interfaces name to a class, which is instantiated.
     * You can use either the ServiceLocator for instantiation or instantiate the class directly.
     *
     * @param string $class
     * @param bool   $useServiceLocator
     * @return object
     */
    public function resolve($class, $useServiceLocator = false);
}
