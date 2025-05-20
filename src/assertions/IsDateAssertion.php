<?php

namespace Hegentopf\Assert\assertions;

class IsDateAssertion extends AbstractDateAssertion {
    protected function check()
    {

        $value = $this->getValue();

        if ( false === $this->toTimestamp( $value ) )
        {
            $this->fail( "Expected {$this->getName()} to be a valid date or DateTime, got: " . $this->getValueFormatted() );
        }
    }
}
