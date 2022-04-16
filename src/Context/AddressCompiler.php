<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;
use Delight\Website\Map\Address;
use ReflectionClass;

class AddressCompiler implements ContextCompilerInterface
{
    private const DEFAULT_KEY = 'address';
    private static ReflectionClass $addressReflection;

    public function __construct(
        public readonly string $key = self::DEFAULT_KEY
    ) {}

    private static function getReflection(): ReflectionClass
    {
        return self::$addressReflection ??= new ReflectionClass(
            Address::class
        );
    }

    private static function compileAddress(array $arguments): Address
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::getReflection()->newInstanceArgs($arguments);
    }

    public function compile(array $context): array
    {
        foreach ($context as $key => $value) {
            if ($key === $this->key && is_array($value)) {
                $context[$key] = self::compileAddress($value);
                continue;
            }

            if (is_array($value)) {
                $context[$key] = $this->compile($value);
            }
        }

        return $context;
    }
}
