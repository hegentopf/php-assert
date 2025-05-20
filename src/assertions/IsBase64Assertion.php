<?php

namespace Hegentopf\Assert\assertions;

class IsBase64Assertion extends AbstractAssertion {
    protected function check()
    {

        $value = $this->getValue();
        if ( !is_string( $value ) || base64_encode( base64_decode( $value, true ) ) !== $value )
        {
            $this->fail( "Expected {$this->getName()} to be valid Base64, got: " . $this->getValueFormatted() );
        }
    }
}
