<?php

/**
 * \AppserverIo\Collections\AbstractMap
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
 * Abstract base class of the Maps.
 *
 * @category  Library
 * @package   Collections
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
abstract class AbstractMap extends AbstractCollection implements Map
{

    /**
     * This method returns the internal array
     * with the keys and the related values.
     *
     * @return array Holds the array with keys and values
     * @see \AppserverIo\Collections\Map::toIndexedArray()
     */
    public function toIndexedArray()
    {
        return $this->items;
    }
}
