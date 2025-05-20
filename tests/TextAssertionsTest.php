<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;

class TextAssertionsTest extends TestCase {
    public function testIsStringPass()
    {

        Assert::that( 'abc' )->isString();
        Assert::that( '123' )->isString();
        Assert::that( 123.3 )->isString();
        $this->assertTrue( true );
    }

    public function testIsStringFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( array() )->isString();
    }

    public function testIsStrictStringPass()
    {

        Assert::that( 'abc' )->isStrictString();
        Assert::that( '123' )->isStrictString();
        $this->assertTrue( true );
    }

    public function testIsStrictStringFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 123 )->isStrictString();
    }

    public function testHasLengthPass()
    {

        Assert::that( 'abc' )->hasLength( 3 );
        $this->assertTrue( true );
    }

    public function testHasLengthFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'abc' )->hasLength( 4 );
        Assert::that( '123.4' )->hasLength( 5 );
        Assert::that( 123.4 )->hasLength( 5 );
    }

    public function testHasMinLengthPass()
    {

        Assert::that( 'abc' )->hasMinLength( 2 );
        Assert::that( 123 )->hasMinLength( 2 );
        $this->assertTrue( true );
    }

    public function testHasMinLengthFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'a' )->hasMinLength( 2 );
    }

    public function testHasMaxLengthPass()
    {

        Assert::that( 'abc' )->hasMaxLength( 3 );
        $this->assertTrue( true );
    }

    public function testHasMaxLengthFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'abcd' )->hasMaxLength( 3 );
    }

    public function testHasLengthBetweenPass()
    {

        Assert::that( 'abc' )->hasLengthBetween( 2, 4 );
        $this->assertTrue( true );
    }

    public function testHasLengthBetweenFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'a' )->hasLengthBetween( 2, 4 );
    }

    public function testMatchesRegexPass()
    {

        Assert::that( 'abc123' )->matchesRegex( '/^[a-z0-9]+$/i' );
        $this->assertTrue( true );
    }

    public function testMatchesRegexFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'abc123!' )->matchesRegex( '/^[a-z0-9]+$/i' );
    }

    public function testStartsWithPass()
    {

        Assert::that( 'foobar' )->startsWith( 'foo' );
        Assert::that( 'foobar' )->startsWith( 'FOO', false );
        $this->assertTrue( true );
    }

    public function testStartsWithFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'foobar' )->startsWith( 'bar' );
    }

    public function testEndsWithPass()
    {

        Assert::that( 'foobar' )->endsWith( 'bar' );
        Assert::that( 'foobar' )->endsWith( 'BAR', false );
        $this->assertTrue( true );
    }

    public function testEndsWithFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'foobar' )->endsWith( 'foo' );
    }

    public function testContainsPass()
    {

        Assert::that( 'foobar' )->contains( 'oba' );
        Assert::that( 'foobar' )->contains( 'OBA', false );
        $this->assertTrue( true );
    }

    public function testContainsFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'foobar' )->contains( 'baz' );
    }

    public function testIsJsonPass()
    {

        Assert::that( '{"foo": "bar"}' )->isJson();
        $this->assertTrue( true );
    }

    public function testIsJsonFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not json' )->isJson();
    }

    public function testIsBase64Pass()
    {

        Assert::that( base64_encode( 'hello' ) )->isBase64();
        $this->assertTrue( true );
    }

    public function testIsBase64Fail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not base64!' )->isBase64();
    }

    public function testIsEmailPass()
    {

        Assert::that( 'test@example.com' )->isEmail();
        $this->assertTrue( true );
    }

    public function testIsEmailFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not-an-email' )->isEmail();
    }
}