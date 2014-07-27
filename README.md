athene2-class-resolver
======================

[![Build Status](https://travis-ci.org/serlo-org/athene2-class-resolver.svg)](https://travis-ci.org/serlo-org/athene2-class-resolver)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-class-resolver/?branch=master)

## Resolve classes like a bauss!

In your module.config.php add:


```php
    'class_resolver'  => [
        'My\ClassInterface' => 'My\CrazyClass'
    ]
```

```php
$classResolver = $serviceManager->get('ClassResolver\ClassResolver');
$className     = $classResolver->resolveClassName('My\ClassInterface');
$class         = $classResolver->resolve('My\ClassInterface');

echo $className; // prints "My\CrazyClass"
echo getclass($class); // prints "My\CrazyClass"
```
