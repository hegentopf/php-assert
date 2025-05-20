<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;

class StructureAssertionsTest extends TestCase {

    public function testIsArrayPass()
    {

        Assert::that( [ 1, 2, 3 ] )->isArray();
        $this->assertTrue( true );
    }

    public function testIsArrayFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not array' )->isArray();
    }

    public function testIsObjectPass()
    {

        Assert::that( new stdClass() )->isObject();
        $this->assertTrue( true );
    }

    public function testIsObjectFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 123 )->isObject();
    }

    public function testIsNullPass()
    {

        Assert::that( null )->isNull();
        $this->assertTrue( true );
    }

    public function testIsNullFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 0 )->isNull();
    }

    public function testIsCallablePass()
    {

        Assert::that( function () {} )->isCallable();
        $this->assertTrue( true );
    }

    public function testIsCallableFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not callable' )->isCallable();
    }

    public function testIsInArrayPass()
    {

        Assert::that( 'a' )->isInArray( [ 'a', 'b', 'c' ] );
        $this->assertTrue( true );
    }

    public function testIsInArrayFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'z' )->isInArray( [ 'a', 'b', 'c' ] );
    }

    public function testIsNotInArrayPass()
    {

        Assert::that( 'z' )->isNotInArray( [ 'a', 'b', 'c' ] );
        $this->assertTrue( true );
    }

    public function testIsNotInArrayFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'a' )->isNotInArray( [ 'a', 'b', 'c' ] );
    }

    public function testIsBoolPass()
    {

        Assert::that( true )->isBool();
        Assert::that( false )->isBool();
        Assert::that( 'false' )->isBool();
        Assert::that( 'true' )->isBool();
        Assert::that( 'on' )->isBool();
        Assert::that( 'off' )->isBool();
        Assert::that( 0 )->isBool();
        Assert::that( 1 )->isBool();
        Assert::that( '0' )->isBool();
        Assert::that( '1' )->isBool();
        $this->assertTrue( true );
    }

    public function testIsBoolFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'asdf' )->isBool();
    }

    public function testIsStrictBoolPass()
    {

        Assert::that( true )->isStrictBool();
        Assert::that( false )->isStrictBool();
        $this->assertTrue( true );
    }

    public function testIsStrictBoolFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 1 )->isStrictBool();
    }

    public function testIsJsonPass()
    {

        Assert::that( '{"key": "value"}' )->isJson();
        $this->assertTrue( true );
    }

    public function testIsJsonFail()
    {

        $this->expectException( AssertException::class );
        Assert::that( '{key: value}' )->isJson();
    }

    public function testIsBase64Pass()
    {

        Assert::that( base64_encode( 'hello' ) )->isBase64();
        $this->assertTrue( true );
    }

    public function testIsBase64Fail()
    {

        $this->expectException( AssertException::class );
        Assert::that( 'not base64' )->isBase64();
    }
}
