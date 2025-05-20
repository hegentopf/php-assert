<?php

namespace Hegentopf\Assert\assertions;

class IsSameAsAssertion extends AbstractAssertion {
    protected $comparison;

    public function __construct( $assert, $comparison )
    {

        parent::__construct( $assert );
        $this->comparison = $comparison;
    }

    protected function check()
    {

        if ( $this->getValue() !== $this->comparison )
        {
            $this->fail( "Expected {$this->getName()} to be identical (===) to " . $this->getValueFormatted( $this->comparison ) . ", got " . $this->getValueFormatted() );
        }
    }
}