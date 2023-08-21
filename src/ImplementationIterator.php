<?php
namespace Scheb;

class ImplementationIterator implements \Iterator
{

    /**
     * @var ImplementationReflectionIterator
     */
    private $reflectionIterator;

    /**
     * Create an iterator on a directory to search for classes implementing an interface or being implementation of a class
     *
     * @param string $directory
     * @param string $namespace
     * @param string $classOrInterface
     */
    public function __construct($directory, $namespace, $classOrInterface)
    {
        $this->reflectionIterator = new ImplementationReflectionIterator($directory, $namespace, $classOrInterface);
    }

    public function current(): mixed
    {
        return $this->reflectionIterator->current()->getName();
    }

    public function next(): void
    {
        $this->reflectionIterator->next();
    }

    public function key(): mixed
    {
        return $this->reflectionIterator->key();
    }

    public function valid(): bool
    {
        return $this->reflectionIterator->valid();
    }

    public function rewind(): void
    {
        $this->reflectionIterator->rewind();
    }
}
