<?php

/**
 * \AppserverIo\Collections\AbstractCollection
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Collections;

use AppserverIo\Lang\Object;
use AppserverIo\Lang\String;
use AppserverIo\Lang\Float;
use AppserverIo\Lang\Integer;
use AppserverIo\Lang\Boolean;
use AppserverIo\Lang\NullPointerException;

/**
 * Abstract base class of the IndexedCollections.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
abstract class AbstractCollection extends Object implements CollectionInterface, \IteratorAggregate
{

    /**
     * Holds the items of the ArrayList
     *
     * @var array
     */
    protected $items = array();

    /**
     * This method returns a new Iter object
     * needed by a foreach structure.
     *
     * @return \AppserverIo\Collections\Iter Holds the Iter object
     * @see \AppserverIo\Collections\IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new Iter($this->items);
    }

    /**
     * This method appends all elements of the
     * passed array to the Collection.
     *
     * @param array $array Holds the array with the values to add
     *
     * @return \AppserverIo\Collections\CollectionInterface The instance
     * @see \AppserverIo\Collections\Collection::addAll($array)
     */
    public function addAll($array)
    {
        foreach ($array as $key => $value) {
            $this->items[$key] = $value;
        }
        // return the instance
        return $this;
    }

    /**
     * This method returns the element with the passed key
     * from the Collection.
     *
     * @param mixed $key Holds the key of the element to return
     *
     * @return mixed The requested element
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an integer
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key OR value are NULL
     * @throws \AppserverIo\Collections\IndexOutOfBoundsException Is thrown if no element with the passed key exists in the Collection
     * @see \AppserverIo\Collections\CollectionInterface::get($key)
     */
    public function get($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            // return the value for the passed key, if it exists
            if (isset($this->items[$key])) {
                return $this->items[$key];
            } else {
                throw new IndexOutOfBoundsException('Index ' . $key . ' out of bounds');
            }
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof String) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Float) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitive datatype or ' . 'has to implement the __toString() method');
            }
            // return the value for the passed key, if it exists
            if (isset($this->items[$newKey])) {
                return $this->items[$newKey];
            } else {
                throw new IndexOutOfBoundsException('Index ' . $newKey . ' out of bounds');
            }
        }
        throw new InvalidKeyException('Passed key has to be a primitive datatype or ' . 'has to implement the __toString() method');
    }

    /**
     * This method checks if an element with the passed
     * key exists in the Collection.
     * If yes the method
     * returns TRUE, else FALSE.
     *
     * @param mixed $key Holds the key of the element to check for
     *
     * @return boolean Returns TRUE if the element exists in the Collection else FALSE
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an integer
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is NULL
     * @see \AppserverIo\Collections\CollectionInterface::exists($key)
     */
    public function exists($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            // return TRUE if a value for the passed key exists, else FALSE
            return isset($this->items[$key]);
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof String) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Float) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitive datatype or ' . 'has to implement the __toString() method');
            }
            // return TRUE if a value for the passed key exists, else FALSE
            return isset($this->items[$newKey]);
        }
        throw new InvalidKeyException('Passed key has to be a primitive datatype or ' . 'has to implement the __toString() method');
    }

    /**
     * This method returns an array with the
     * items of the Dictionary. The keys are
     * lost in the array.
     *
     * @return array Holds an array with the items of the Dictionary
     * @see \AppserverIo\Collections\CollectionInterface::toArray()
     */
    public function toArray()
    {
        return array_values($this->items);
    }

    /**
     * This method returns the number of entries of the Collection.
     *
     * @return integer The number of entries
     * @see \AppserverIo\Collections\CollectionInterface::size()
     */
    public function size()
    {
        return sizeof($this->items);
    }

    /**
     * This method initializes the Collection and removes
     * all existing entries.
     *
     * @return void
     * @see \AppserverIo\Collections\CollectionInterface::clear()
     */
    public function clear()
    {
        $this->items = array();
    }

    /**
     * This returns true if the Collection has no
     * entries, otherwise false.
     *
     * @return boolean
     * @see \AppserverIo\Collections\Collection::isEmpty()
     */
    public function isEmpty()
    {
        if ($this->size() == 0) {
            return true;
        }
        return false;
    }

    /**
     * This method removes the element with the passed key, that has to be an integer, from the IndexedCollection.
     *
     * @param mixed $key Holds the key of the element to remove
     *
     * @return void
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an integer
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is NULL
     * @throws \AppserverIo\Collections\IndexOutOfBoundsException
     */
    public function remove($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            if (isset($this->items[$key])) {
                // remove the item
                unset($this->items[$key]);
                // return the instance
                return $this;
            } else {
                throw new IndexOutOfBoundsException('Index ' . $key . ' out of bounds');
            }
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof String) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Float) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitive datatype or ' . 'has to implement the __toString() method');
            }
            if (isset($this->items[$newKey])) {
                // remove the item
                unset($this->items[$newKey]);
                // returns the instance
                return $this;
            } else {
                throw new IndexOutOfBoundsException('Index ' . $newKey . ' out of bounds');
            }
        }
        throw new InvalidKeyException('Passed key has to be a primitive datatype or ' . 'has to implement the __toString() method');
    }

    /**
     * This method merges the elements of the passed map
     * with the elements of the actual map.
     *
     * If the keys are equal, the existing value is taken, else
     * the new one is appended.
     *
     * @param \AppserverIo\Collections\CollectionInterface $col Holds the Collection with the values to merge
     *
     * @return void
     * @deprecated Does not work correctly
     */
    public function merge(CollectionInterface $col)
    {
        // union the items of the two maps
        $this->items = $this->items + $col->toArray();
    }

    /**
     * This method checks if an element with the passed
     * value exists in the ArrayList.
     *
     * @param mixed $value Holds the value to check the elements of the array list for
     *
     * @return boolean Returns true if an element with the passed value exists in the array list
     */
    public function contains($value)
    {
        // initialize the return value
        $isEqual = false;
        // run through all elements an check if the one
        // of the items is equal to the passed one
        foreach ($this->items as $item) {
            if ($item == $value) {
                $isEqual = true;
            }
        }
        // return false if the value is not found
        return $isEqual;
    }
}
