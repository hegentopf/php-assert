<?php

namespace Hegentopf\Assert\assertions;

class IsStringAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_string( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be a string, got {$this->getValueFormatted()}" );
        }
    }
}