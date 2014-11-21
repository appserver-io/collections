<?php

/**
 * \AppserverIo\Collections\Enumeration
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
 * Interface for lists of objects that can be returned in sequence.
 *
 * Successive objects are obtained by the nextElement method.
 *
 * @category  Library
 * @package   Collections
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2014 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
interface Enumeration
{

    /**
     * Tests whether there are elements remaining in the enumeration.
     *
     * @return true if there is at least one more element in the enumeration, that is, if the next call to nextElement will not throw a NoSuchElementException.
     */
    public function hasMoreElements();

    /**
     * Obtain the next element in the enumeration.
     *
     * @return the next element in the enumeration
     * @throws \AppserverIo\Collections\NoSuchElementException if there are no more elements
     */
    public function nextElement();
}
