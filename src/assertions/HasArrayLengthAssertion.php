<?php

namespace Hegentopf\Assert\assertions;

class HasArrayLengthAssertion extends AbstractAssertion
{
    protected $length;
    public static $isArrayAssertion = true;

    public function __construct( $assert, $length )
    {
        parent::__construct( $assert );
        $this->length = $length;
    }

    protected function check()
    {
        $this->assert->isArray();

        $len = count( $this->getValue() );
        if ( $len !== $this->length ) {
            $this->fail( "Expected {$this->getName()} to have array length {$this->length}, got length {$len}" );
        }
    }
}