<?php

/**
 * \AppserverIo\Collections\Collection
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

/**
 * Interface of all Collection objects.
 *
 * @category  Library
 * @package   Collections
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
interface Collection
{

    /**
     * This method returns the number of entries of the Collection.
     *
     * @return integer The number of entries
     */
    public function size();

    /**
     * This method initializes the Collection and removes
     * all exsiting entries.
     *
     * @return void
     */
    public function clear();

    /**
     * This returns true if the Collection has no
     * entries, otherwise false.
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     * This method returns an array with the
     * items of the Dictionary.
     *
     * The keys are lost in the array.
     *
     * @return array Holds an array with the items of the Dictionary
     */
    public function toArray();

    /**
     * This method appends all elements of the
     * passed array to the Collection.
     *
     * @param array $array Holds the array with the values to add
     *
     * @return \AppserverIo\Collections\Collection The instance
     */
    public function addAll($array);

    /**
     * This method returns the object, identified by the key
     * passed as a parameter, from the Collection.
     *
     * @param mixed $key The key of the element to return
     *
     * @return mixed Holds the entry identified by the passed key
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is invalid
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is NULL
     * @throws \AppserverIo\Collections\IndexOutOfBoundsException If element with passed key is not in the collection
     */
    public function get($key);

    /**
     * This method checks if the element with the passed
     * key exists in the Collection.
     *
     * @param mixed $key Holds the key to check the elements of the Collection for
     *
     * @return boolean Returns true if an element with the passed key exists in the Collection
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is invalid
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is NULL
     */
    public function exists($key);
}
