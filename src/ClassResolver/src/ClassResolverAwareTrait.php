<?php
namespace ClassResolver;

/**
 * Class ClassResolverAwareTrait
 *
 * @package ClassResolver
 * @author Aeneas Rekkas
 */
trait ClassResolverAwareTrait
{

    /**
     * @var ClassResolverInterface
     */
    protected $classResolver;

    /**
     * @return ClassResolverInterface $classResolver
     */
    public function getClassResolver()
    {
        return $this->classResolver;
    }

    /**
     * @param ClassResolverInterface $classResolver
     * @return self
     */
    public function setClassResolver(ClassResolverInterface $classResolver)
    {
        $this->classResolver = $classResolver;

        return $this;
    }
}
