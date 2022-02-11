<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use LogicException;

abstract class AbstractObject implements IteratorAggregate, ArrayAccess
{
    abstract protected function getObjectProperties(): array;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator(
            $this->getObjectProperties()
        );
    }

    public function offsetExists($offset): bool
    {
        return $this->getIterator()->offsetExists($offset);
    }

    public function offsetGet($offset): mixed
    {
        return $this->getIterator()->offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $property = preg_replace('/^og:[^:]+:?/', '', $offset) ?: 'url';

        if (!property_exists($this, $property)) {
            throw new LogicException(
                sprintf(
                    'Cannot set value to "%s" on OpenGraph Object.',
                    $offset
                )
            );
        }

        $this->{$property} = $value;
    }

    public function offsetUnset($offset): void
    {
        throw new LogicException(
            sprintf(
                'Cannot unset "%s" of OpenGraph Object.',
                $offset
            )
        );
    }
}
