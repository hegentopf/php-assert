<?php

namespace Hegentopf\Assert;

/**
 * @method Assert isInt()
 * @method Assert isStrictInt()
 * @method Assert isFloat()
 * @method Assert isStrictFloat()
 * @method Assert isNumeric()
 * @method Assert isGreaterThan( $greaterThen )
 */
class Assert {

    protected $value;
    protected $name;
    protected $optional = false;
    protected $keyExists = true;

    protected $results = array();

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

        $keyExists = false;
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

        $assert = new self( $value, $key );
        $assert->setKeyExists( $keyExists );

        return $assert;
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
            throw new \BadMethodCallException( "Method $name does not exist" );
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
    public function getKeyExists()
    {

        return $this->keyExists;
    }

    public function setKeyExists( $exists )
    {

        $this->keyExists = $exists;

        return $this;
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

    public function optional()
    {

        $this->optional = true;

        return $this;
    }


    // For internal use, indicate if key exists or not

    public function required()
    {

        $this->optional = false;
        if ( false === $this->keyExists )
        {
            throw new AssertException( "Value for '{$this->name}' must be present." );
        }

        return $this;
    }


}