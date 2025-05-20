<?php

namespace Hegentopf\Assert\assertions;

class StartsWithAssertion extends AbstractAssertion {
    protected $prefix;
    protected $caseSensitive;

    public function __construct( $assert, $prefix, $caseSensitive = false )
    {

        parent::__construct( $assert );
        $this->prefix = $prefix;
        $this->caseSensitive = $caseSensitive;
    }

    protected function check()
    {

        $this->assert->isString();

        $value = $this->getValue();
        $prefix = $this->prefix;

        if ( !$this->caseSensitive )
        {
            $value = strtolower( $value );
            $prefix = strtolower( $prefix );
        }

        if ( substr( $value, 0, strlen( $prefix ) ) !== $prefix )
        {
            $this->fail( "Expected {$this->getName()} to start with '{$this->prefix}'" . ( $this->caseSensitive ? "" : " (case-insensitive)" ) . ", got '{$this->getValue()}'" );
        }
    }
}
