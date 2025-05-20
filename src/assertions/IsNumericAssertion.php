<?php

namespace Hegentopf\Assert\assertions;

use Hegentopf\Assert\AssertException;

class IsNumericAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_numeric( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be numeric, got " . $this->getValueFormatted() );
        }
    }
}