<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;

class NumericAssertionsTest extends TestCase {
    public function testIsIntPass()
    {

        Assert::that( 123 )->isInt();
        Assert::that( '123' )->isInt();
        $this->assertTrue( true );
    }

    public function testIsIntFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'asdf' )->isInt();
    }

    public function testIsStrictIntPass()
    {

        Assert::that( 456 )->isStrictInt();
        $this->assertTrue( true );
    }

    public function testIsStrictIntFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 456.0 )->isStrictInt();
    }

    public function testIsFloatPass()
    {

        Assert::that( 1.23 )->isFloat();
        Assert::that( '1.23' )->isFloat();
        $this->assertTrue( true );
    }

    public function testIsFloatFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'asdf' )->isFloat();
    }

    public function testIsStrictFloatPass()
    {

        Assert::that( 3.14 )->isStrictFloat();
        $this->assertTrue( true );
    }

    public function testIsStrictFloatFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 3 )->isStrictFloat();
    }

    public function testIsNumericPass()
    {

        Assert::that( '123' )->isNumeric();
        Assert::that( 123 )->isNumeric();
        Assert::that( '1.23' )->isNumeric();
        $this->assertTrue( true );
    }

    public function testIsNumericFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'abc' )->isNumeric();
    }

    public function testIsGreaterThanPass()
    {

        Assert::that( 10 )->isGreaterThan( 5 );
        $this->assertTrue( true );
    }

    public function testIsGreaterThanFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 4 )->isGreaterThan( 5 );
    }

    public function testIsGreaterThanOrEqualPass()
    {

        Assert::that( 5 )->isGreaterThanOrEqual( 5 );
        Assert::that( 6 )->isGreaterThanOrEqual( 5 );
        $this->assertTrue( true );
    }

    public function testIsGreaterThanOrEqualFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 4 )->isGreaterThanOrEqual( 5 );
    }

    public function testIsLessThanPass()
    {

        Assert::that( 3 )->isLessThan( 5 );
        $this->assertTrue( true );
    }

    public function testIsLessThanFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 5 )->isLessThan( 5 );
    }

    public function testIsLessThanOrEqualPass()
    {

        Assert::that( 5 )->isLessThanOrEqual( 5 );
        Assert::that( 4 )->isLessThanOrEqual( 5 );
        $this->assertTrue( true );
    }

    public function testIsLessThanOrEqualFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 6 )->isLessThanOrEqual( 5 );
    }

    public function testIsBetweenInclusivePass()
    {

        Assert::that( 5 )->isBetween( 5, 6 );
        Assert::that( 6 )->isBetween( 5, 6 );
        Assert::that( 5.5 )->isBetween( 5, 6 );
        $this->assertTrue( true );
    }

    public function testIsBetweenExclusiveFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 5 )->isBetween( 5, 6, false );
    }
}