<?php

namespace Hegentopf\Assert\assertions;

class IsLessThanAssertion extends AbstractAssertion {
    protected $max;

    public function __construct( $assert, $max )
    {

        parent::__construct( $assert );
        $this->max = $max;
    }

    protected function check()
    {

        $this->assert->isNumeric();

        if ( $this->getValue() >= $this->max )
        {
            $this->fail( "Expected {$this->getName()} to be less than {$this->max}, got {$this->getValueFormatted()}" );
        }
    }
}
