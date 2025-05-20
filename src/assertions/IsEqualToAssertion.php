<?php

namespace Hegentopf\Assert\assertions;

class IsEqualToAssertion extends AbstractAssertion {
    protected $value;

    public function __construct( $assert, $comparison )
    {

        parent::__construct( $assert );
        $this->value = $comparison;
    }

    protected function check()
    {

        if ( $this->getValue() != $this->value )
        {
            $this->fail( "Expected {$this->getName()} to be equal to " . var_export( $this->value, true ) . ", got " . $this->getValueFormatted() );
        }
    }
}