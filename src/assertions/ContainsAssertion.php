<?php

namespace Hegentopf\Assert\assertions;

class ContainsAssertion extends AbstractAssertion {
    protected $needle;
    protected $caseSensitive;

    public function __construct( $assert, $needle, $caseSensitive = false )
    {

        parent::__construct( $assert );
        $this->needle = $needle;
        $this->caseSensitive = $caseSensitive;
    }

    protected function check()
    {

        $this->assert->isString();

        $value = $this->getValue();
        $needle = $this->needle;

        if ( !$this->caseSensitive )
        {
            $value = strtolower( $value );
            $needle = strtolower( $needle );
        }

        if ( strpos( $value, $needle ) === false )
        {
            $this->fail( "Expected {$this->getName()} to contain '{$this->needle}'" . ( $this->caseSensitive ? "" : " (case-insensitive)" ) . ", got '{$this->getValue()}'" );
        }
    }
}
