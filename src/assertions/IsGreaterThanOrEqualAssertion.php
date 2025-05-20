<?php

namespace Hegentopf\Assert\assertions;

class IsGreaterThanOrEqualAssertion extends AbstractAssertion {
    protected $min;

    public function __construct( $assert, $min )
    {

        parent::__construct( $assert );
        $this->min = $min;
    }

    protected function check()
    {

        $this->assert->isNumeric();

        if ( $this->getValue() < $this->min )
        {
            $this->fail( "Expected {$this->getName()} to be greater than or equal to {$this->min}, got {$this->getValueFormatted()}" );
        }
    }
}
