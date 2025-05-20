<?php

namespace Hegentopf\Assert\assertions;

abstract class AbstractDateAssertion extends AbstractAssertion {
    protected function toTimestamp( $value )
    {

        if ( $value instanceof \DateTimeInterface )
        {
            return $value->getTimestamp();
        }

        if ( is_string( $value ) )
        {
            return strtotime( $value );
        }

        return false;
    }

    protected function formatAny( $value )
    {

        if ( $value instanceof \DateTimeInterface )
        {
            return $value->format( 'Y-m-d H:i:s' );
        }

        return (string)$value;
    }
}
