<?php

namespace Hegentopf\Assert\assertions;

class HasMaxLengthAssertion extends AbstractAssertion {
    protected $maxLength;

    public function __construct( $assert, $maxLength )
    {

        parent::__construct( $assert );
        $this->maxLength = $maxLength;
    }

    protected function check()
    {

        $this->assert->isString();

        $len = strlen( $this->getValue() );
        if ( $len > $this->maxLength )
        {
            $this->fail( "Expected {$this->getName()} to have maximum length {$this->maxLength}, got length {$len}" );
        }
    }
}
