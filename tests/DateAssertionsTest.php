<?php

namespace Hegentopf\Assert\Tests;

use DateTime;
use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;

class DateAssertionsTest extends TestCase {
    public function testIsDatePass()
    {

        Assert::that( '2023-05-01' )->isDate();
        Assert::that( '2023-05-01 12:30:00' )->isDate();
        Assert::that( new DateTime( '2023-05-01 12:30:00' ) )->isDate();
        $this->assertTrue( true );
    }

    public function testIsDateFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not-a-date' )->isDate();
    }

    public function testIsDateGreaterThanPass()
    {

        Assert::that( '2023-05-02' )->isDateGreaterThan( '2023-05-01' );
        $this->assertTrue( true );
    }

    public function testIsDateGreaterThanFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( '2023-05-01' )->isDateGreaterThan( '2023-05-02' );
    }

    public function testIsDateGreaterThanOrEqualPass()
    {

        Assert::that( '2023-05-01' )->isDateGreaterThanOrEqual( '2023-05-01' );
        Assert::that( '2023-05-02' )->isDateGreaterThanOrEqual( '2023-05-01' );
        Assert::that( '2023-05-02' )->isDateGreaterThanOrEqual( new DateTime( '2023-05-01' ) );
        $this->assertTrue( true );
    }

    public function testIsDateGreaterThanOrEqualFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( '2023-05-01' )->isDateGreaterThanOrEqual( '2023-05-02' );
    }

    public function testIsDateLessThanPass()
    {

        Assert::that( '2023-05-01' )->isDateLessThan( '2023-05-02' );
        $this->assertTrue( true );
    }

    public function testIsDateLessThanFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( '2023-05-02' )->isDateLessThan( '2023-05-01' );
    }

    public function testIsDateLessThanOrEqualPass()
    {

        Assert::that( '2023-05-01' )->isDateLessThanOrEqual( '2023-05-01' );
        Assert::that( '2023-04-30' )->isDateLessThanOrEqual( '2023-05-01' );
        $this->assertTrue( true );
    }

    public function testIsDateLessThanOrEqualFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( '2023-05-02' )->isDateLessThanOrEqual( '2023-05-01' );
    }

    public function testIsDateBetweenPass()
    {

        Assert::that( '2023-05-02' )->isDateBetween( '2023-05-01', '2023-05-03' );
        $this->assertTrue( true );
    }

    public function testIsDateBetweenFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( '2023-04-30' )->isDateBetween( '2023-05-01', '2023-05-03' );
    }
}