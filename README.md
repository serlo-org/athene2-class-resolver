athene2-class-resolver
======================

[![Build Status](https://travis-ci.org/serlo-org/athene2-class-resolver.svg)](https://travis-ci.org/serlo-org/athene2-class-resolver)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/?branch=master)

The Athene2 Class Resolver is a Zend Framework 2 Module which lets you **resolve classes like a bauss!**.
Using Interfaces for Doctrine Entities? No problem, the class resolver helps you find the right implementation!

## Usage



In your module.config.php add:

```php
    'class_resolver'  => [
        'My\ClassInterface' => 'My\CrazyClass'
    ]
```

Now you can easily resolve the interface either to a class name (which is useful for e.g. Doctrine Entities) or to
a real class:

```php
$classResolver = $serviceManager->get('ClassResolver\ClassResolver');
$className     = $classResolver->resolveClassName('My\ClassInterface');
$class         = $classResolver->resolve('My\ClassInterface');

echo $className; // prints "My\CrazyClass"
echo get_class($class); // prints "My\CrazyClass"
```

If you wish to instantiate the class through Zend's ServiceManager, do the following:

```php
$classResolver = $serviceManager->get('ClassResolver\ClassResolver');
$class         = $classResolver->resolve('My\ClassInterface', true);

echo get_class($class); // prints "My\CrazyClass"
```