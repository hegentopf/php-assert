<?php

namespace Hegentopf\Assert\assertions;

class IsEmailAssertion extends AbstractAssertion {
    protected function check()
    {

        $value = $this->getValue();
        if ( !is_string( $value ) || !filter_var( $value, FILTER_VALIDATE_EMAIL ) )
        {
            $this->fail( "Expected {$this->getName()} to be a valid email address, got: " . $this->getValueFormatted() );
        }
    }
}
