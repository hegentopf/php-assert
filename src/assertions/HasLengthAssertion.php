<?php

namespace Hegentopf\Assert\assertions;

class HasLengthAssertion extends AbstractAssertion {
    protected $length;

    public function __construct( $assert, $length )
    {

        parent::__construct( $assert );
        $this->length = $length;
    }

    protected function check()
    {

        $this->assert->isString();

        $len = strlen( $this->getValue() );
        if ( $len !== $this->length )
        {
            $this->fail( "Expected {$this->getName()} to have length {$this->length}, got length {$len}" );
        }
    }
}
