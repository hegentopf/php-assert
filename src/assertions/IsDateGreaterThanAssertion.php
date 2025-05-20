<?php

namespace Hegentopf\Assert\assertions;

class IsDateGreaterThanAssertion extends AbstractDateAssertion {
    protected $date;

    public function __construct( $assert, $date )
    {

        parent::__construct( $assert );
        $this->date = $date;
    }

    protected function check()
    {

        $this->assert->isDate();

        $valueDate = $this->toTimestamp( $this->getValue() );
        $compareDate = $this->toTimestamp( $this->date );

        if ( false === $compareDate )
        {
            $this->fail( "Invalid comparison date provided: " . $this->formatAny( $this->date ) );
        }

        if ( false === $valueDate || $valueDate <= $compareDate )
        {
            $this->fail(
                "Expected {$this->getName()} to be greater than " .
                $this->formatAny( $this->date ) .
                ", got {$this->getValueFormatted()}"
            );
        }
    }
}
