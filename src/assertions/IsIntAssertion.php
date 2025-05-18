<?php

namespace Hegentopf\Assert\assertions;

use Hegentopf\Assert\AssertException;

class IsIntAssertion extends abstractAssertion {

    protected function check( $threshold = null )
    {

        if (is_int($this->getValue())) {
            return;
        }

        if (is_string($this->getValue()) && preg_match('/^-?\d+$/', $this->getValue())) {
            return;
        }

        $this->fail("Expected {$this->getName()} to be an integer or integer-like string, got " . $this->getValueFormatted());
    }

}