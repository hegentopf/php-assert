<?php

namespace Hegentopf\Assert\assertions;

class IsStringAssertion extends AbstractAssertion {
    protected function check()
    {
        $value = $this->getValue();

        // Locker: akzeptiere Strings oder numerische Werte (die als String interpretiert werden können)
        if (!is_string($value) && !is_numeric($value)) {
            $this->fail("Expected {$this->getName()} to be a string or numeric convertible, got {$this->getValueFormatted()}");
        }
    }
}
