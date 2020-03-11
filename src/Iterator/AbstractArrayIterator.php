<?php

namespace BoasPraticas\Bots\Iterator;

use ArrayIterator;
use Countable;
use Iterator;

abstract class AbstractArrayIterator implements Iterator, Countable
{
    protected $iterator;

    public function __construct(array $results)
    {
        $this->iterator = new ArrayIterator($results);
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function key()
    {
        return $this->iterator->key();
    }

    public function valid()
    {
        return $this->iterator->valid();
    }

    public function rewind()
    {
        $this->iterator->rewind();
    }

    public function count()
    {
        return $this->iterator->count();
    }
}
