<?php

namespace Hegentopf\Assert\assertions;

class HasArrayLengthBetweenAssertion extends AbstractAssertion
{
    protected $minLength;
    protected $maxLength;

    public function __construct( $assert, $minLength, $maxLength )
    {
        parent::__construct( $assert );
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    protected function check()
    {
        $this->assert->isArray();

        $len = count( $this->getValue() );
        if ( $len < $this->minLength || $len > $this->maxLength ) {
            $this->fail( "Expected {$this->getName()} to have array length between {$this->minLength} and {$this->maxLength}, got length {$len}" );
        }
    }
}