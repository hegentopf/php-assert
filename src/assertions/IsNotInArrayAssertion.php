<?php

namespace Hegentopf\Assert\assertions;

class IsNotInArrayAssertion extends AbstractAssertion {
    protected $haystack;
    protected $strict;

    public function __construct( $assert, array $haystack, $strict = false )
    {

        parent::__construct( $assert );
        $this->haystack = $haystack;
        $this->strict = $strict;
    }

    protected function check()
    {

        if ( in_array( $this->getValue(), $this->haystack, $this->strict ) )
        {
            $this->fail( "Expected {$this->getName()} NOT to be in array " . json_encode( $this->haystack ) . ", got {$this->getValueFormatted()}" );
        }
    }
}
