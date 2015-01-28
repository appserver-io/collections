<?php

/**
 * \AppserverIo\Collections\TestComparator
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

/**
 * This class is the comparator sorting
 * an array by its values.
 *
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/collections
 * @link      http://www.appserver.io
 */
class TestComparator implements ComparatorInterface
{

    /**
     * This method compares the begin date of the objects passed as
     * parameter .
     *
     *
     * @param object $o1 Holds the first object to compare
     * @param object $o2 Holds the second object to compare
     *
     * @return integer Returns 0 if the begin date is equal Returns 1 if the begin date of the first value is smaller. Returns -1 if the begin date of the first value is greater
     */
    public function compare($o1, $o2)
    {
        // get the values from the objects
        $value1 = $o1;
        $value2 = $o2;
        // if value 1 is smaller than value 2
        if ($value1 < $value2) {
            return - 1;
        }
        // if value 1 and 2 are equal
        if ($value1 == $value2) {
            return 0;
        }
        // if value 1 is greater than value 2
        if ($value1 > $value2) {
            return 1;
        }
    }
}
