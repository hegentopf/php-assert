<?php

namespace Hegentopf\Assert;

use BadMethodCallException;

/**
 * @method Assert isInt()
 * @method Assert isStrictInt()
 * @method Assert isFloat()
 * @method Assert isStrictFloat()
 * @method Assert isNumeric()
 * @method Assert isGreaterThan( $min )
 * @method Assert isGreaterThanOrEqual( $min )
 * @method Assert isLessThan( $max )
 * @method Assert isLessThanOrEqual( $max )
 * @method Assert isBetween( $min, $max, $inclusive = true )
 * @method Assert isBool()
 * @method Assert isStrictBool()
 * @method Assert isJson()
 * @method Assert isBase64()
 * @method Assert isObject()
 * @method Assert isArray()
 * @method Assert IsNotInArray( array $haystack, $strict = false )
 * @method Assert IsInArray( array $haystack, $strict = false )
 * @method Assert isCallable()
 * @method Assert isNull()
 * @method Assert isEqualTo( $comparison )
 * @method Assert isNotEqualTo( $comparison )
 * @method Assert isSameAs( $comparison )
 * @method Assert isNotSameAs( $comparison )
 * @method Assert isString()
 * @method Assert isStrictString()
 * @method Assert hasLength()
 * @method Assert hasMinLength( $minLength )
 * @method Assert hasMaxLength( $maxLength )
 * @method Assert hasLengthBetween( $minLength, $maxLength )
 * @method Assert matchesRegex( $pattern )
 * @method Assert startsWith( $prefix, $caseSensitive = false )
 * @method Assert endsWith( $suffix, $caseSensitive = false )
 * @method Assert contains( $needle, $caseSensitive = false )
 * @method Assert isEmail()
 * @method Assert isDate()
 * @method Assert isDateGreaterThan( $date )
 * @method Assert isDateGreaterThanOrEqual( $date )
 * @method Assert isDateLessThan( $date )
 * @method Assert isDateLessThanOrEqual( $date )
 * @method Assert isDateBetween( $minDate, $maxDate, $inclusive = true )
 * @method Assert hasArrayLengthAssertion( $length )
 * @method Assert hasMinArrayLength( $minLength )
 * @method Assert hasMaxArrayLength( $maxLength )
 * @method Assert hasArrayLengthBetween( $minLength, $maxLength )
 * @throws AssertException
 */
class Assert {

    protected $value;
    protected $name;
    protected $optional = false;
    protected $results = array();
    protected $each = false;
    protected $eachRecursive = false;

    public function __construct( $value, $name )
    {

        $this->value = $value;
        $this->name = $name;
    }

    /**
     * @param $value
     * @param $name
     * @return self
     */
    public static function that( $value, $name = 'value' )
    {

        return new self( $value, $name );
    }

    /**
     * Factory for asserting a key in an array or object.
     *
     * @param array|object $container The array or object to get value from
     * @param string|int   $key The key or property name
     * @return Assert
     * @throws AssertException
     */
    public static function thatKey( $container, $key )
    {

        $value = null;

        if ( is_array( $container ) )
        {
            $keyExists = array_key_exists( $key, $container );
            if ( $keyExists )
            {
                $value = $container[ $key ];
            }
        }
        elseif ( is_object( $container ) )
        {
            $keyExists = property_exists( $container, $key );
            if ( !$keyExists && method_exists( $container, '__get' ) )
            {
                // __get might dynamically allow access, but we can't know if it "exists"
                // So we assume keyExists = true, but still check value !== null
                $keyExists = true;
            }
            if ( $keyExists )
            {
                $value = $container->$key;
            }
        }
        else
        {
            throw new AssertException( "Can only assert keys in array or object. Got: " . gettype( $container ) );
        }

        return new self( $value, $key );
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call( $name, $arguments )
    {

        $className = __NAMESPACE__ . '\\assertions\\' . ucfirst( $name ) . 'Assertion';
        if ( !class_exists( $className ) )
        {
            throw new BadMethodCallException( "Method $name does not exist" );
        }

        if ($this->each && ($iterable = $this->getIterable($this->value))) {
            if ($this->eachRecursive) {
                $this->applyRecursiveAssertions($iterable, $name, $arguments, $this->name);
            } else {
                foreach ($iterable as $idx => $item) {
                    $assert = new self($item, "{$this->name}[$idx]");
                    $assert->optional = $this->optional;
                    $assert->each = false;
                    $assert->eachRecursive = false;
                    $assert->$name(...$arguments);
                }
            }
            return $this;
        }
            
        $assertion = new $className( $this, ...$arguments );
        $assertion->assert();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {

        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * @return bool
     */
    public function getIsOptional()
    {

        return $this->optional;
    }

    /**
     * @param string $assertionName
     * @return bool
     */
    public function hasResult( $assertionName )
    {

        return array_key_exists( $assertionName, $this->results );
    }


    // Mark the value as optional (skip further checks if null)

    /**
     * @param string $assertionName
     * @param mixed  $result
     * @return void
     */
    public function addResult( $assertionName, $result )
    {

        $this->results[ $assertionName ] = $result;
    }

    // Mark the value as required, throw if key missing

    public function isOptional()
    {

        $this->optional = true;

        return $this;
    }

    // Activate the each mode, which will assert each element of an array
    public function each()
    {

        $this->each = true;
        $this->eachRecursive = false;

        return $this;
    }

    // Activate the eachRecursive mode, which will recursively assert each element of a nested array
    public function eachRecursive()
    {
        $this->each = true;
        $this->eachRecursive = true;
        
        return $this;
    }

    protected function applyRecursiveAssertions($value, $name, $arguments, $path)
    {
        $className = __NAMESPACE__ . '\\assertions\\' . ucfirst($name) . 'Assertion';
        $isArrayAssertion = property_exists($className, 'isArrayAssertion') && $className::$isArrayAssertion;

        $iterable = $this->getIterable($value);

        if ($iterable !== null) {
            if ($isArrayAssertion) {
                $assert = new self($value, $path);
                $assert->optional = $this->optional;
                $assert->each = false;
                $assert->eachRecursive = false;
                $assert->$name(...$arguments);
            }
            foreach ($iterable as $idx => $item) {
                $this->applyRecursiveAssertions($item, $name, $arguments, "{$path}[$idx]");
            }
        } else {
            if (!$isArrayAssertion) {
                $assert = new self($value, $path);
                $assert->optional = $this->optional;
                $assert->each = false;
                $assert->eachRecursive = false;
                $assert->$name(...$arguments);
            }
        }
    }

    protected function getIterable($value)
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_object($value)) {
            return get_object_vars($value);
        }
        return null;
    }

}