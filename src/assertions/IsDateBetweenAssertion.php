<?php

namespace Hegentopf\Assert\assertions;

class IsDateBetweenAssertion extends AbstractDateAssertion {
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

        $this->assert->isDate();

        $valueTs = $this->toTimestamp( $this->getValue() );
        $minTs = $this->toTimestamp( $this->min );
        $maxTs = $this->toTimestamp( $this->max );

        if ( false === $minTs )
        {
            $this->fail( "Invalid comparison min-date provided: " . $this->formatAny( $this->min ) );
        }

        if ( false === $maxTs )
        {
            $this->fail( "Invalid comparison max-date provided: " . $this->formatAny( $this->max ) );
        }

        $valid = $this->inclusive
            ? ( $valueTs >= $minTs && $valueTs <= $maxTs )
            : ( $valueTs > $minTs && $valueTs < $maxTs );

        if ( false === $valid )
        {
            $op = $this->inclusive ? 'between (inclusive)' : 'strictly between';
            $this->fail(
                "Expected {$this->getName()} to be $op " .
                $this->formatAny( $this->min ) . " and " .
                $this->formatAny( $this->max ) .
                ", got " . $this->getValueFormatted()
            );
        }
    }
}
