<?php

namespace Hegentopf\Assert\assertions;

class IsNullAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_null( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be null, got {$this->getValueFormatted()}" );
        }
    }
}