<?php

/**
 * \AppserverIo\Collections\HashMap
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

use \AppserverIo\Lang\Strng;
use \AppserverIo\Lang\Integer;
use \AppserverIo\Lang\Flt;
use \AppserverIo\Lang\Boolean;
use \AppserverIo\Lang\NullPointerException;
use \AppserverIo\Lang\ClassCastException;

/**
 * This class is the implementation of a HashMap.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
class HashMap extends AbstractMap
{

    /**
     * Standard constructor that adds the array passed
     * as parameter to the internal member variable.
     *
     * @param array $items An array to initialize the HashMap
     *
     * @throws \AppserverIo\Lang\ClassCastException Is thrown if the passed parameter is not of type array
     */
    public function __construct($items = array())
    {
        // parent constructor to ensure property preset
        parent::__construct();

        // check if NULL is passed, is yes, to nothing
        if (is_null($items)) {
            return;
        }
        // check if an array is passed
        if (is_array($items)) {
            // initialize the HashMap with the values of the passed array
            foreach ($items as $key => $item) {
                $this->add($key, $item);
            }
            return;
        }
        // if not a array is passed throw an exception
        throw new ClassCastException('Passed object is not an array');
    }

    /**
     * This method adds the passed object with the passed key
     * to the HashMap.
     *
     * @param mixed $key    The key to add the passed value under
     * @param mixed $object The object to add to the HashMap
     *
     * @return \AppserverIo\Collections\HashMap The instance
     * @throws \AppserverIo\Collections\InvalidKeyException Is thrown if the passed key is NOT an primitive datatype
     * @throws \AppserverIo\Lang\NullPointerException Is thrown if the passed key is null or not a flat datatype like Integer, Strng, Double or Boolean
     */
    public function add($key, $object)
    {
        if (is_null($key)) {
            throw new NullPointerException('Passed key is null');
        }
        // check if a primitive datatype is passed
        if (is_integer($key) || is_string($key) || is_double($key) || is_bool($key)) {
            // add the item to the array
            $this->items[$key] = $object;
            // and return
            return;
        }
        // check if an object is passed
        if (is_object($key)) {
            if ($key instanceof Strng) {
                $newKey = $key->stringValue();
            } elseif ($key instanceof Flt) {
                $newKey = $key->floatValue();
            } elseif ($key instanceof Integer) {
                $newKey = $key->intValue();
            } elseif ($key instanceof Boolean) {
                $newKey = $key->booleanValue();
            } elseif (method_exists($key, '__toString')) {
                $newKey = $key->__toString();
            } else {
                throw new InvalidKeyException('Passed key has to be a primitive datatype or  has to implement the __toString() method');
            }
            // add the item to the array
            $this->items[$newKey] = $object;
            // and return
            return;
        }
        throw new InvalidKeyException('Passed key has to be a primitive datatype or  has to implement the __toString() method');
    }

    /**
     * This method Returns a new HashMap initialized with the
     * passed array.
     *
     * @param array $array Holds the array to initialize the new HashMap
     *
     * @return \AppserverIo\Collections\HashMap Returns a HashMap initialized with the passed array
     * @throws \AppserverIo\Lang\ClassCastException Is thrown if the passed object is not an array
     */
    public static function fromArray($array)
    {
        // check if the passed object is an array and set it
        if (is_array($array)) {
            return new HashMap($array);
        }
        // throw an exception if the passed object is not an array
        throw new ClassCastException('Passed object is not an array');
    }
}
