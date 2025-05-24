<?php

namespace Hegentopf\Assert\assertions;

class HasMaxArrayLengthAssertion extends AbstractAssertion
{
    protected $maxLength;
    public static $isArrayAssertion = true;

    public function __construct( $assert, $maxLength )
    {
        parent::__construct( $assert );
        $this->maxLength = $maxLength;
    }

    protected function check()
    {
        $this->assert->isArray();

        $len = count( $this->getValue() );
        if ( $len > $this->maxLength ) {
            $this->fail( "Expected {$this->getName()} to have maximum array length {$this->maxLength}, got length {$len}" );
        }
    }
}