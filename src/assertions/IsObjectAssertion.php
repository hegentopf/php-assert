<?php

namespace Hegentopf\Assert\assertions;

class IsObjectAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_object( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be an object, got {$this->getValueFormatted()}" );
        }
    }
}