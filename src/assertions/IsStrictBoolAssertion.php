<?php

namespace Hegentopf\Assert\assertions;

class isStrictBoolAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_bool( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be a boolean, got {$this->getValueFormatted()}" );
        }
    }
}