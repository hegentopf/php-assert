<?php

namespace Hegentopf\Assert\assertions;

class MatchesRegexAssertion extends AbstractAssertion {
    protected $pattern;

    public function __construct( $assert, $pattern )
    {

        parent::__construct( $assert );
        $this->pattern = $pattern;
    }

    protected function check()
    {

        $this->assert->isString();

        if ( false == preg_match( $this->pattern, $this->getValue() ) )
        {
            $this->fail( "Expected {$this->getName()} to match regex pattern {$this->pattern}, got {$this->getValueFormatted()}" );
        }
    }
}
