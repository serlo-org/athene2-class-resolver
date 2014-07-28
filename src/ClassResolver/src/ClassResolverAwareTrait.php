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
     * The ClassResolver instance
     *
     * @var ClassResolverInterface
     */
    protected $classResolver;

    /**
     * Gets the ClassResolver
     *
     * @return ClassResolverInterface $classResolver
     */
    public function getClassResolver()
    {
        return $this->classResolver;
    }

    /**
     * Sets the ClassResolver
     *
     * @param ClassResolverInterface $classResolver
     * @return void
     */
    public function setClassResolver(ClassResolverInterface $classResolver)
    {
        $this->classResolver = $classResolver;
    }
}
