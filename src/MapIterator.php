<?php
namespace Scheb;

/**
 * Maps values before yielding
 *
 * Taken from guzzle/guzzle: https://github.com/Guzzle3/iterator/blob/master/MapIterator.php
 */
class MapIterator extends \IteratorIterator
{
    /** @var mixed Callback */
    protected $callback;
    /**
     * @param \Traversable   $iterator Traversable iterator
     * @param array|\Closure $callback Callback used for iterating
     *
     * @throws \InvalidArgumentException if the callback if not callable
     */
    public function __construct(\Traversable $iterator, $callback)
    {
        parent::__construct($iterator);
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('The callback must be callable');
        }
        $this->callback = $callback;
    }
    public function current(): mixed
    {
        return call_user_func($this->callback, parent::current());
    }
}
