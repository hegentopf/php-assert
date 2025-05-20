<?php

namespace Hegentopf\Assert\assertions;

class IsBetweenAssertion extends AbstractAssertion {
    protected $min;
    protected $max;
    protected $inclusive;

    public function __construct( $assert, $min, $max, $inclusive = true )
    {

        parent::__construct( $assert );
        $this->min = $min;
        $this->max = $max;
        $this->inclusive = $inclusive;
    }

    protected function check()
    {

        $this->assert->isNumeric();

        $value = $this->getValue();
        if ( $this->inclusive )
        {
            if ( $value < $this->min || $value > $this->max )
            {
                $this->fail( "Expected {$this->getName()} to be between {$this->min} and {$this->max} inclusive, got {$this->getValueFormatted()}" );
            }
        }
        else
        {
            if ( $value <= $this->min || $value >= $this->max )
            {
                $this->fail( "Expected {$this->getName()} to be strictly between {$this->min} and {$this->max}, got {$this->getValueFormatted()}" );
            }
        }
    }
}
