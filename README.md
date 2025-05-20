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
- `isString()`
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
