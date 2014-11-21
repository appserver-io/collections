<?php

/**
 * \AppserverIo\Collections\Enum
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

use AppserverIo\Lang\Object;

/**
 * Interface for lists of objects that can be returned in sequence.
 *
 * Successive  objects are obtained by the nextElement method.
 *
 * @category  Library
 * @package   Collections
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
class Enum extends Object implements Enumeration
{

    /**
     * The possible items.
     *
     * @var array
     */
    protected $items = null;

    /**
     * The point to the actual item.
     *
     * @var integer
     */
    protected $itemPointer = 0;

    /**
     * Standardconstructor that adds the array passed
     * as parameter to the internal membervariable.
     *
     * @param array $items An array to initialize the Enumeration
     *
     * @return void
     */
    public function __construct($items = array())
    {
        $this->items = $items;
    }

    /**
     * Tests whether there are elements remaining in the enumeration.
     *
     * @return true if there is at least one more element in the enumeration, that is, if the next call to nextElement will not throw a NoSuchElementException.
     * @see \AppserverIo\Collections\Enumeration::hasMoreElements()
     */
    public function hasMoreElements()
    {
        if (count($this->items) > $this->itemPointer) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Obtain the next element in the enumeration.
     *
     * @return the next element in the enumeration
     * @throws \AppserverIo\Collections\NoSuchElementException if there are no more elements
     * @see \AppserverIo\Collections\Enumeration::nextElement()
     */
    public function nextElement()
    {
        if (array_key_exists($this->itemPointer, $this->items)) {
            return $this->items[$this->itemPointer ++];
        } else {
            throw new NoSuchElementException('No such element was found');
        }
    }
}
