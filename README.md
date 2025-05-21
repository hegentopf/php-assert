# php-assert

A lightweight and fluent PHP assertion library for easy and expressive validations.

---

## Overview

**php-assert** is a PHP assertion utility designed to provide an elegant and chainable interface for validating data types, values, and object keys. It supports a variety of common assertions such as type checks, range checks, string validations, date comparisons, and more.

The library throws `AssertException` on failed assertions, allowing you to handle validation errors cleanly.

---

## Features

- Fluent and chainable assertion syntax
- Assertions for types: int, float, bool, string, array, object, null, callable, etc.
- Value comparisons: greater than, less than, between, equality, etc.
- String validations: length, regex, contains, startsWith, endsWith, email
- Date validations: isDate, date range checks
- Optional keys support for objects and arrays
- Strict and non-strict checks
- Works with PHP arrays and `stdClass` objects seamlessly

---

## Installation

Install via Composer:

```bash
composer require hegentopf/php-assert
```

---

## Usage

```php
use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;

// Simple assertion
Assert::that(42)->isInt()->isGreaterThan(10);

// Assert key in array or object
Assert::thatKey(['foo' => 'bar'], 'foo')->isString()->hasMinLength(3);

// Optional key validation (passes if key is missing or null)
Assert::thatKey($obj, 'optionalDate')->isOptional()->isDate();
```

---

## Available Assertions

The following assertions are currently implemented and chainable:

- `isInt()`, `isStrictInt()`
- `isFloat()`, `isStrictFloat()`
- `isNumeric()`
- `isGreaterThan($min)`, `isGreaterThanOrEqual($min)`
- `isLessThan($max)`, `isLessThanOrEqual($max)`
- `isBetween($min, $max, $inclusive = true)`
- `isBool()`, `isStrictBool()`
- `isJson()`
- `isBase64()`
- `isObject()`
- `isArray()`
- `isNotInArray(array $haystack, $strict = false)`
- `isInArray(array $haystack, $strict = false)`
- `isCallable()`
- `isNull()`
- `isEqualTo($comparison)`
- `isNotEqualTo($comparison)`
- `isSameAs($comparison)`
- `isNotSameAs($comparison)`
- `isString()`, `isStrictString()`
- `hasLength()`
- `hasMinLength($minLength)`
- `hasMaxLength($maxLength)`
- `hasLengthBetween($minLength, $maxLength)`
- `matchesRegex($pattern)`
- `startsWith($prefix, $caseSensitive = false)`
- `endsWith($suffix, $caseSensitive = false)`
- `contains($needle, $caseSensitive = false)`
- `isEmail()`
- `isDate()`
- `isDateGreaterThan($date)`
- `isDateGreaterThanOrEqual($date)`
- `isDateLessThan($date)`
- `isDateLessThanOrEqual($date)`
- `isDateBetween($minDate, $maxDate, $inclusive = true)`
- `hasArrayLengthAssertion( $length )`
- `hasMinArrayLength( $minLength )`
- `hasMaxArrayLength( $maxLength )`
- `hasArrayLengthBetween( $minLength, $maxLength )`

---

## Array Loop Assertions with `each()` and `eachRecursive()`

The `each()` method allows you to apply assertions to every element of an array (only the first level).  
The `eachRecursive()` method applies assertions to every element of an array recursively, including all nested arrays.  
This is especially useful when you want to ensure that all values in an array (or nested arrays) meet a specific type or condition.

**Examples:**

```php
use Hegentopf\Assert\Assert;

// Check if all values in the array are floats (first level only)
Assert::that([3.14, 2.71])->isArray()->each()->isStrictFloat();

// Works with associative arrays as well
Assert::that(['a' => 1, 'b' => 2])->isArray()->each()->isInt();

// Validate nested arrays: check that each element is an array (first level)
Assert::that([[1, 2], [3, 4]])->isArray()->each()->isArray();

// Recursively check that all values in nested arrays are integers
Assert::that([[1, 2], [3, 4]])->isArray()->eachRecursive()->isInt();

// Optional validation for each element (first level)
Assert::that([null, 3.14, 2.71])->isArray()->each()->isOptional()->isStrictFloat();

// Optional validation for all nested elements
Assert::that([[null, 3.14], [2.71, null]])->isArray()->eachRecursive()->isOptional()->isStrictFloat();
```

With `each()` and `eachRecursive()`, you can chain any assertions and they will be applied to every element in the array (either only the first level or recursively). Optional checks (`isOptional()`) are correctly propagated to nested arrays.

---

## Testing

Unit tests are provided and use PHPUnit.

To run tests:

```bash
composer install
./vendor/bin/phpunit
```

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## Contribution

Contributions, issues, and feature requests are welcome! Feel free to open a pull request or issue.

---

## Maintainer

Michael Helmert

---

Thank you for using **php-assert**!
