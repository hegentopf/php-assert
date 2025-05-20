<?php

namespace Hegentopf\Assert\assertions;

class IsBoolAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( null === filter_var( $this->getValue(), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE ) )
        {
            $this->fail( "Expected {$this->getName()} to be a like a boolean, got {$this->getValueFormatted()}" );
        }


    }
}