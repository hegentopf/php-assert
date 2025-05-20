<?php

namespace Hegentopf\Assert\assertions;

class IsNotSameAsAssertion extends AbstractAssertion {
    protected $value;

    public function __construct( $assert, $comparison )
    {

        parent::__construct( $assert );
        $this->value = $comparison;
    }

    protected function check()
    {

        if ( $this->getValue() === $this->value )
        {
            $this->fail( "Expected {$this->getName()} to NOT be identical (!==) to " . var_export( $this->value, true ) . ", but it was." );
        }
    }
}