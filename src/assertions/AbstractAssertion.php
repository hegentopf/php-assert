<?php

namespace Hegentopf\Assert\assertions;

use Hegentopf\Assert\AssertException;
use Hegentopf\Assert\Assert;

abstract class AbstractAssertion implements AssertionInterface {

    protected $failureMessage = null;

    /**
     * @var Assert|null
     */
    protected $assert; // instanceof Assert oder null
    /**
     * @var true
     */
    protected $passed = true;

    protected function getValue()
    {

        return $this->assert->getValue();
    }


    protected function getName()
    {

        return $this->assert->getName();
    }

    /**
     * @param Assert $context
     */
    public function __construct( Assert $assert )
    {

        $this->assert = $assert;
    }

    public function assert()
    {

        if ( true === $this->assert->getIsOptional() && null === $this->assert->getValue() )
        {
            return;
        }

        if ( $this->assert->hasResult( get_class( $this ) ) )
        {
            return;
        }

        $this->check();

        $this->assert->addResult( get_class( $this ), $this->passed );

        if ( false === $this->passed )
        {
            throw new AssertException( $this->failureMessage );
        }
    }

    abstract protected function check();

    protected function fail( $message )
    {

        $this->passed = false;
        $this->failureMessage = $message;
    }

    /**
     * @return true
     */
    public function isPassed()
    {

        return $this->passed;
    }

    /**
     * @param true $passed
     */
    public function setPassed( $passed )
    {

        $this->passed = $passed;
    }

    protected function getValueFormatted()
    {

        $value = $this->getValue();

        if ( is_object( $value ) )
        {
            return 'object(' . get_class( $value ) . ')';
        }

        if ( is_array( $value ) )
        {
            return 'array(' . count( $value ) . ')';
        }

        if ( is_resource( $value ) )
        {
            return 'resource';
        }

        if ( is_null( $value ) )
        {
            return 'null';
        }

        if ( is_bool( $value ) )
        {
            return true === $value ? 'true' : 'false';
        }

        if ( is_string( $value ) )
        {
            return "string('" . $value . "')";
        }

        return gettype( $value ) . "('" . $value . "')";
    }
}
