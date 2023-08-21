<?php

use PHPUnit\Framework\TestCase;
use Scheb\ImplementationIterator;

class ImplementationIteratorTest extends TestCase
{

    /**
     * @param string $instanceOf
     *
     * @return ImplementationIterator
     */
    public function createIterator($instanceOf): ImplementationIterator
    {
        return new ImplementationIterator(__DIR__ . DIRECTORY_SEPARATOR . 'Fixtures', 'Scheb\\Tests\\Fixtures', $instanceOf);
    }

    /**
     * Return array of elements from iterator
     *
     * @param \Iterator $iterator
     *
     * @return array
     */
    private function getArray(\Iterator $iterator): array
    {
        $elements = array();
        foreach ($iterator as $element) {
            $elements[] = $element;
        }

        return $elements;
    }

    public function testInterfaceReturnsImplementations(): void
    {
        $iterator = $this->createIterator('Scheb\\Tests\\Fixtures\\AInterface');
        $this->assertImplementations($iterator);
    }

    public function testAbstractClassReturnsImplementations(): void
    {
        $iterator = $this->createIterator('Scheb\\Tests\\Fixtures\\AbstractAImplementation');
        $this->assertImplementations($iterator);
    }

    public function testClassReturnsExtensions(): void
    {
        $iterator = $this->createIterator('Scheb\\Tests\\Fixtures\\AImplementation');
        $array = $this->getArray($iterator);
        $this->assertContains('Scheb\\Tests\\Fixtures\\AImplementationExtension', $array);
    }

    private function assertImplementations($iterator): void
    {
        $array = $this->getArray($iterator);
        $this->assertContains('Scheb\\Tests\\Fixtures\\AImplementation', $array);
        $this->assertContains('Scheb\\Tests\\Fixtures\\AImplementationExtension', $array);
        $this->assertContains('Scheb\\Tests\\Fixtures\\SubNamespace\\AImplementation', $array);
        $this->assertContains('Scheb\\Tests\\Fixtures\\SubNamespace\\SubSubNamespace\\AImplementation', $array);
    }
}
