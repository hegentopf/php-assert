<?php

namespace Hegentopf\Assert\assertions;

class IsStrictIntAssertion extends AbstractAssertion {

    protected function check()
    {

        if ( false === is_int( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be strictly an integer, got " . $this->getValueFormatted() );
        }
    }
}