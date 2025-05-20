<?php

namespace Hegentopf\Assert\assertions;

class IsJsonAssertion extends AbstractAssertion {
    protected function check()
    {

        $value = $this->getValue();
        if ( !is_string( $value ) )
        {
            $this->fail( "Expected {$this->getName()} to be a JSON string, got non-string" );
        }

        json_decode( $value );
        if ( json_last_error() !== JSON_ERROR_NONE )
        {
            $this->fail( "Expected {$this->getName()} to be valid JSON, got: " . $this->getValueFormatted() );
        }
    }
}
