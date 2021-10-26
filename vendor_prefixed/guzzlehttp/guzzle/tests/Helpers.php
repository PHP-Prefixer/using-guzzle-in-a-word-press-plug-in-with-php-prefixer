<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

namespace PPP\GuzzleHttp\Tests;

class Helpers
{
    public static function readObjectAttribute(object $object, string $attributeName)
    {
        $reflector = new \ReflectionObject($object);

        do {
            try {
                $attribute = $reflector->getProperty($attributeName);

                if (!$attribute || $attribute->isPublic()) {
                    return $object->$attributeName;
                }

                $attribute->setAccessible(true);

                try {
                    return $attribute->getValue($object);
                } finally {
                    $attribute->setAccessible(false);
                }
            } catch (\ReflectionException $e) {
                // do nothing
            }
        } while ($reflector = $reflector->getParentClass());

        throw new \Exception(
            sprintf('Attribute "%s" not found in object.', $attributeName)
        );
    }
}
