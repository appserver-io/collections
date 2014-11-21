<?php

/**
 * \AppserverIo\Collections\IdentityDictionary
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   Collections
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
namespace AppserverIo\Collections;

use AppserverIo\Lang\NullPointerException;

/**
 * This class is the implementation of a Dictionary.
 *
 * A dictionary uses objects as keys instead of integers
 * like a HashMap.
 *
 * @category  Library
 * @package   Collections
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
class IdentityDictionary extends Dictionary
{

    /**
     * This method returns the element that has the passed
     * key as a reference (has to be an object) from the
     * Dictionary.
     *
     * @param object $key Holds the key to the key of the element to return
     *
     * @return mixed The requested value
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key OR value are NULL
     * @throws \AppserverIo\Collections\IndexOutOfBoundsException Is thrown if no element with the passed key exists in the Dictionary
     * @see \AppserverIo\Collections\IndexedCollection::get($key)
     */
    public function get($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (!is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // run over all keys and check if one is equal to the passed one
        foreach ($this->keys as $id => $value) {
            // if the actual is equal to the passed key ..
            if ($key === $value) {
                // return the item with the passed key
                if (array_key_exists($id, $this->items)) {
                    return $this->items[$id];
                }
            }
        }
        // if no value is found throw an exception
        throw new IndexOutOfBoundsException('Index out of bounds');
    }

    /**
     * This method checks if the element that has the passed
     * key as a reference (has to be an object) exists in
     * the Dictionary.
     *
     * @param object $key Holds the reference to the key of the element that should exists in the Dictionary
     *
     * @return boolean Returns TRUE if an element with the passed key exists in the Dictionary
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is NULL
     * @see \AppserverIo\Collections\IndexedCollection::exists($key)
     */
    public function exists($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (! is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // run over all keys and check if one is equal to the passed one
        foreach ($this->keys as $id => $value) {
            // if the actual is equal to the passed key ..
            if ($key === $value) {
                // return TRUE if the key is found
                return true;
            }
        }
        // return FALSE if the key is not found
        return false;
    }

    /**
     * This method removes the element that has the passed
     * key as a reference (has to be an object) from the
     * Dictionary.
     *
     * @param object $key Holds the reference of the key of the element to remove
     *
     * @return void
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an object
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is NULL
     * @throws \AppserverIo\Collections\IndexOutOfBoundsException Is thrown if no element with the passed key exists in the Dictionary
     */
    public function remove($key)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        if (! is_object($key)) {
            throw new InvalidKeyException('Passed key has to be an object');
        }
        // run over all keys and check if one is a reference of the passed one
        foreach ($this->keys as $id => $value) {
            // if the actual is equal to the passed key ..
            if ($key === $value) {
                // unset the elements
                unset($this->items[$id]);
                unset($this->keys[$id]);
                return;
            }
        }
        // throw an exception if key is not found in internal array
        throw new IndexOutOfBoundsException('Index out of bounds');
    }
}
