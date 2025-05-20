<?php

namespace Hegentopf\Assert\assertions;

class IsArrayAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_array( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be an array, got {$this->getValueFormatted()}" );
        }
    }
}