<?php

namespace Hegentopf\Assert\assertions;

class EndsWithAssertion extends AbstractAssertion {
    protected $suffix;
    protected $caseSensitive;

    public function __construct( $assert, $suffix, $caseSensitive = false )
    {

        parent::__construct( $assert );
        $this->suffix = $suffix;
        $this->caseSensitive = $caseSensitive;
    }

    protected function check()
    {

        $this->assert->isString();

        $value = $this->getValue();
        $suffix = $this->suffix;

        if ( !$this->caseSensitive )
        {
            $value = strtolower( $value );
            $suffix = strtolower( $suffix );
        }

        if ( substr( $value, -strlen( $suffix ) ) !== $suffix )
        {
            $this->fail( "Expected {$this->getName()} to end with '{$this->suffix}'" . ( $this->caseSensitive ? "" : " (case-insensitive)" ) . ", got '{$this->getValue()}'" );
        }
    }
}
