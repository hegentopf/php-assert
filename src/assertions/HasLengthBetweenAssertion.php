<?php

namespace Hegentopf\Assert\assertions;

class HasLengthBetweenAssertion extends AbstractAssertion {
    protected $min;
    protected $max;

    public function __construct( $assert, $min, $max )
    {

        parent::__construct( $assert );
        $this->min = $min;
        $this->max = $max;
    }

    protected function check()
    {

        $this->assert->isString();

        $len = strlen( $this->getValue() );
        if ( $len < $this->min || $len > $this->max )
        {
            $this->fail( "Expected {$this->getName()} to have length between {$this->min} and {$this->max}, got length {$len}" );
        }
    }
}
