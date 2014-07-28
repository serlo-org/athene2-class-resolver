<?php
namespace ClassResolver;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ClassResolver
 *
 * @package ClassResolver
 * @author  Aeneas Rekkas
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

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param array                   $config
     */
    public function __construct(ServiceLocatorInterface $serviceLocator, $config = [])
    {
        $this->serviceLocator = $serviceLocator;
        foreach ($config as $from => $to) {
            $this->addClass($from, $to);
        }
    }

    /**
     * @param string $from
     * @param string $to
     */
    protected function addClass($from, $to)
    {
        $this->registry[$this->getIndex($from)] = $to;
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getIndex($key)
    {
        return preg_replace('/[^a-z0-9]/i', '_', (string)$key);
    }

    /**
     * @param string $class
     * @return string
     * @throws Exception\RuntimeException
     * @throws Exception\InvalidArgumentException
     */
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
            $message = sprintf("Class `%s` not found, resolved from %s.", $this->registry[$index], $class);
            throw new Exception\RuntimeException($message);
        }

        return $this->registry[$index];
    }

    /**
     * {@inheritDoc}
     */
    public function resolveClassName($interface)
    {
        return $this->getClass($interface);
    }

    /**
     * {@inheritDoc}
     */
    public function resolve($class, $useServiceLocator = false)
    {
        $className = $this->getClass($class);

        if ($useServiceLocator) {
            $instance = $this->serviceLocator->get($this->getClass($class));
        } else {
            $instance = new $className();
        }

        if (!$instance instanceof $class) {
            $message = sprintf('Class %s does not implement %s', get_class($instance), $class);
            throw new Exception\RuntimeException($message);
        }

        return $instance;
    }
}
