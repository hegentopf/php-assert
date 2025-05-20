<?php

namespace Hegentopf\Assert\assertions;

class IsStrictFloatAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_float( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be strictly a float, got " . $this->getValueFormatted() );
        }
    }
}