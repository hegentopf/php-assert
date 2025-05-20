<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;
use function PHPUnit\Framework\assertInstanceOf;

class AssertTest extends TestCase {
    public function testAssertThatPass()
    {

        assertInstanceOf( Assert::class, Assert::that( 1 ) );
    }

    public function testAssertThatKeyPass()
    {

        $array = [ 'test' => 3.14 ];
        $obj = new stdClass();
        $obj->test = 3.14;

        assertInstanceOf( Assert::class, Assert::thatKey( $array, 'test' )->isStrictFloat() );
        assertInstanceOf( Assert::class, Assert::thatKey( $obj, 'test' )->isStrictFloat() );
    }

    public function testAssertThatKeyOptionalPass()
    {

        $obj = new stdClass();
        $obj->foo = '2023-05-01';

        assertInstanceOf( Assert::class, Assert::thatKey( $obj, 'foo' )->isOptional()->isDate() );

        assertInstanceOf( Assert::class, Assert::thatKey( $obj, 'bar' )->isOptional()->isDate() );
    }

    public function testAssertThatKeyOptionalFail()
    {

        $this->expectException( AssertException::class );

        $obj = new stdClass();
        $obj->foo = 'not-a-date';

        Assert::thatKey( $obj, 'foo' )->isOptional()->isDate();
    }

    public function testAssertThatKeyMandatoryFail()
    {

        $this->expectException( AssertException::class );

        $obj = new stdClass();

        Assert::thatKey( $obj, 'bar' )->isDate();
    }

    public function testChainedAssertionsPass()
    {

        Assert::that( 'hello@example.com' )
            ->isString()
            ->hasMinLength( 5 )
            ->contains( '@' )
            ->isEmail();
        $this->assertTrue( true );
    }

    public function testChainedAssertionsFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'short' )
            ->isString()
            ->hasMinLength( 10 )
            ->contains( '@' );
    }

    public function testChainedDateAssertionsPass()
    {

        Assert::that( '2024-05-01' )
            ->isDate()
            ->isDateGreaterThanOrEqual( '2024-01-01' )
            ->isDateLessThanOrEqual( '2024-12-31' );
        $this->assertTrue( true );
    }

    public function testChainedNumericAssertionsPass()
    {

        Assert::that( 42 )
            ->isInt()
            ->isGreaterThan( 10 )
            ->isLessThan( 100 )
            ->isBetween( 30, 50 );
        $this->assertTrue( true );
    }

    public function testChainedOptionalWithOtherAssertions()
    {

        $obj = new stdClass();
        $obj->foo = null;

        // Will pass because optional() allows null
        Assert::thatKey( $obj, 'foo' )
            ->isOptional()
            ->isString()
            ->hasMaxLength( 10 );
        $this->assertTrue( true );
    }
}
