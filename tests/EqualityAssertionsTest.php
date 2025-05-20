<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;

class EqualityAssertionsTest extends TestCase {
    public function testIsEqualToPass()
    {

        Assert::that( 5 )->isEqualTo( 5 );
        Assert::that( "test" )->isEqualTo( "test" );
        Assert::that( 10 )->isEqualTo( "10" ); // loose equality
        $this->assertTrue( true );
    }

    public function testIsEqualToFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 5 )->isEqualTo( 6 );
    }

    public function testIsNotEqualToPass()
    {

        Assert::that( 5 )->isNotEqualTo( 6 );
        Assert::that( "foo" )->isNotEqualTo( "bar" );
        $this->assertTrue( true );
    }

    public function testIsNotEqualToFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 5 )->isNotEqualTo( 5 );
    }

    public function testIsSameAsPass()
    {

        Assert::that( 5 )->isSameAs( 5 );
        Assert::that( "test" )->isSameAs( "test" );
        Assert::that( null )->isSameAs( null );
        $this->assertTrue( true );
    }

    public function testIsSameAsFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 5 )->isSameAs( "5" ); // different types
    }

    public function testIsNotSameAsPass()
    {

        Assert::that( 5 )->isNotSameAs( "5" ); // different types
        Assert::that( 10 )->isNotSameAs( 11 );
        $this->assertTrue( true );
    }

    public function testIsNotSameAsFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 5 )->isNotSameAs( 5 );
    }
}
