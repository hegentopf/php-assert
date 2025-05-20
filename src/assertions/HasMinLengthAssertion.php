<?php

namespace Hegentopf\Assert\assertions;

class HasMinLengthAssertion extends AbstractAssertion {
    protected $minLength;

    public function __construct( $assert, $minLength )
    {

        parent::__construct( $assert );
        $this->minLength = $minLength;
    }

    protected function check()
    {

        $this->assert->isString();

        $len = strlen( $this->getValue() );
        if ( $len < $this->minLength )
        {
            $this->fail( "Expected {$this->getName()} to have minimum length {$this->minLength}, got length {$len}" );
        }
    }
}
