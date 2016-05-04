# PHP collection library


[![Latest Stable Version](https://img.shields.io/packagist/v/appserver-io/collections.svg?style=flat-square)](https://packagist.org/packages/appserver-io/collections) 
 [![Total Downloads](https://img.shields.io/packagist/dt/appserver-io/collections.svg?style=flat-square)](https://packagist.org/packages/appserver-io/collections)
 [![License](https://img.shields.io/packagist/l/appserver-io/collections.svg?style=flat-square)](https://packagist.org/packages/appserver-io/collections)
 [![Build Status](https://img.shields.io/travis/appserver-io/collections/master.svg?style=flat-square)](http://travis-ci.org/appserver-io/collections)
 [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/appserver-io/collections/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/appserver-io/collections/?branch=master)
 [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/appserver-io/collections/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/appserver-io/collections/?branch=master)

## Introduction

This package provides a generic collection library.

The library is based on the SPL extension of PHP5 and uses the introduced iterators. The library
also provides, beside the most used collection types, interfaces and exceptions.

## Issues

In order to bundle our efforts we would like to collect all issues regarding this package in [the main project repository's issue tracker](https://github.com/appserver-io/appserver/issues).
Please reference the originating repository as the first element of the issue title e.g.:
`[appserver-io/<ORIGINATING_REPO>] A issue I am having`

## Usage

The following examples will give you a short introduction how you can use the classes provided by this
library.

### ArrayList

An ArrayList will provide a container that can store items of different data types. With the provided methods,
elements can be added, returned oder deleted. The ArrayList is unsorted and has an ongoing integer index that
starts with 0.

```php
// initialize a new ArrayList object $list = new ArrayList(); 
// add several values 
$list->add(new Integer(1)); 
$list->add(new Integer(2));
foreach($list as $key => $item) {
    echo "Found item with key " . $key . " value " . $item->__toString() . PHP_EOL; 
} 

// produces the following output 
Found item with key 0 and value 1 Found item with key 1 and value 2 
```

### HashMap

A HashMap will provide a container that can store items of different data types. With the provided methods,
elements can be added, returned oder deleted. The HashMap is unsorted like an ArrayList and all simple data
types are supported as index.

```php
// initialize a new HashMap object 
$map = new HashMap(); 

// add several values 
$map->add("number", new Integer(1)); 
$map->add("string", new String("foo")); 
foreach($list as $key => $item) { 
    echo "Found item with key " . $key . " and value " . $item->__toString() . PHP_EOL;
} 

// produces the following output 
Found item with key number and value 1 Found item with key string and value foo
```

### Dictionary 

A Dictionary, like an ArrayList or a HashMap, will provide a container that can store items of different
data types. With the provided methods, elements can be added, returned oder deleted. The Dictionary is
unsorted like an ArrayList. But in opposite to an ArrayList or a HashMap, between simple data types, also 
objects are allowed as index.

```php
// initialize a new Dictionary object 
$dictionary = new Dictionary(); 

// add several values 
$dictionary->add(new Integer(1), new Integer(12)); 
$dictionary->add(new String("foo"), new String("foo")); 

foreach($dictionary as $key => $item) {
    echo "Found item with key " . $key->__toString() . " and value " . $item->__toString() . PHP_EOL;
}

// produces the following output
Found item with key 1 and value foo Found item with key foo and value 12
```

### TreeMap

The usage of a TreeMap is very similar to a HashMap. The main difference is, that the items are either
sorted ascending, or by the Predicate passed to the constructor.

```php
// initialize a new TreeMap object 
$map = new TreeMap(); 

// add several values 
$map->add(2, new Integer(12)); 
$map->add(1, new String("foo")); 

foreach($map as $key => $item) {
    echo "Found item with key " . $key . " and value " . $item->__toString() . PHP_EOL;
}

// produces the following output
Found item with key 1 and value foo Found item with key 2 and value 12
```

The next example gives you an example implementation for using a TreeMap, sorted with a Comparator.

```php
/** 
 * A class TestComparator to sort TreeMap by value.
 */
class TestComparator implements Comparator
{
    
    public function compare($object1, $object2)
    { 
        
        if ($object1->intValue() < $object2->intValue()) { 
            return -1;
        } 
        
        if ($object1->intValue() > $object2->intValue()) { 
            return 1;
        }
        
        if ($object1->intValue() == $object2->intValue()) {
            return 0;
        }
    } 
} 

// initialize a new TreeMap object and pass the TestComparator to the constructor 
$map = new TreeMap(new TestComparator()); 

// add several values
$map->add(1, new Integer(14)); 
$map->add(2, new Integer(13)); 
$map->add(3, new Integer(15)); 

foreach($map as $key => $item) { 
    echo "Found item with key " . $key . " and value " . $item->__toString() . PHP_EOL;
}

// produces the following output
Found item with key 2 and value 13 Found item with key 1 and value 14 Found item with key 3 and value 15
```

## External Links

* Documentation at [appserver.io](http://docs.appserver.io)
