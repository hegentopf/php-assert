<?php

namespace Hegentopf\Assert\assertions;

class IsCallableAssertion extends AbstractAssertion {
    protected function check()
    {

        if ( !is_callable( $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to be callable, got {$this->getValueFormatted()}" );
        }
    }
}