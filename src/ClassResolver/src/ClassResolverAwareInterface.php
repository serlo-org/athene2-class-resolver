<?php
namespace ClassResolver;

/**
 * Interface ClassResolverAwareInterface
 *
 * @package ClassResolver
 * @author Aeneas Rekkas
 */
interface ClassResolverAwareInterface
{

    /**
     * @return self
     */
    public function getClassResolver();

    /**
     * @param ClassResolverInterface $classResolver
     * @return self
     */
    public function setClassResolver(ClassResolverInterface $classResolver);
}
