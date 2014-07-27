<?php
namespace ClassResolver;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ClassResolver
 *
 * @package ClassResolver
 * @author Aeneas Rekkas
 */
class ClassResolver implements ClassResolverInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var array
     */
    protected $registry;

    public function __construct(ServiceLocatorInterface $serviceLocator, $config = [])
    {
        $this->serviceLocator = $serviceLocator;
        foreach ($config as $from => $to) {
            $this->addClass($from, $to);
        }
    }

    protected function addClass($from, $to)
    {
        $this->registry[$this->getIndex($from)] = $to;

        return $this;
    }

    protected function getIndex($key)
    {
        return preg_replace('/[^a-z0-9]/i', '_', (string)$key);
    }

    protected function getClass($class)
    {
        if (!is_string($class)) {
            throw new Exception\InvalidArgumentException(sprintf('Argument is not a string.'));
        }

        $index = $this->getIndex($class);

        if (!array_key_exists($index, $this->registry)) {
            throw new Exception\RuntimeException(sprintf("Can't resolve %s (%s).", $class, $index));
        }
        if (!class_exists($this->registry[$index])) {
            throw new Exception\RuntimeException(sprintf(
                "Class `%s` not found, resolved from %s.",
                $this->registry[$index],
                $class
            ));
        }

        return $this->registry[$index];
    }

    public function resolveClassName($class)
    {
        return $this->getClass($class);
    }

    public function resolve($class, $userServiceLocator = false)
    {
        $className = $this->getClass($class);

        if ($userServiceLocator) {
            $instance = $this->serviceLocator->get($this->getClass($class));
        } else {
            $instance = new $className();
        }

        if (!$instance instanceof $class) {
            throw new Exception\RuntimeException(sprintf(
                'Class %s does not implement %s',
                get_class($instance),
                $class
            ));
        }

        return $instance;
    }
}
