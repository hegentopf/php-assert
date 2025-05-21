<?php

namespace Hegentopf\Assert\assertions;

class HasMinArrayLengthAssertion extends AbstractAssertion
{
    protected $minLength;

    public function __construct( $assert, $minLength )
    {
        parent::__construct( $assert );
        $this->minLength = $minLength;
    }

    protected function check()
    {
        $this->assert->isArray();

        $len = count( $this->getValue() );
        if ( $len < $this->minLength ) {
            $this->fail( "Expected {$this->getName()} to have minimum array length {$this->minLength}, got length {$len}" );
        }
    }
}