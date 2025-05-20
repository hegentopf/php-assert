<?php

namespace Hegentopf\Assert\assertions;

use Hegentopf\Assert\AssertException;

class IsGreaterThanAssertion extends AbstractAssertion {
    protected $greaterThan;

    public function __construct( $assert, $min )
    {

        parent::__construct( $assert );
        $this->greaterThan = $min;
    }

    protected function check()
    {

        // Erst sicherstellen, dass Wert numerisch ist
        $this->assert->isNumeric();

        if ( $this->getValue() <= $this->greaterThan )
        {
            $this->fail( "Expected {$this->getName()} to be greater than {$this->greaterThan}, got {$this->getValueFormatted()}" );
        }
    }
}