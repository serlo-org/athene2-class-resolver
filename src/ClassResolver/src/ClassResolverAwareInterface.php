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
     * @return ClassResolverInterface
     */
    public function getClassResolver();

    /**
     * @param ClassResolverInterface $classResolver
     * @return void
     */
    public function setClassResolver(ClassResolverInterface $classResolver);
}
