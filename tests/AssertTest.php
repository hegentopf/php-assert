<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertInstanceOf;

class AssertTest extends TestCase {

    public function testAssertThat(  )
    {

        assertInstanceOf(Assert::class, Assert::that(1));

    }
    public function testAssertThatKey( )
    {

        $array = array('test' => 3.14);
        $obj = new \stdClass();
        $obj->test = 3.14;
        assertInstanceOf(Assert::class, Assert::thatKey($array, 'test')->isStrictFloat());
        assertInstanceOf(Assert::class, Assert::thatKey($obj, 'test')->isStrictFloat());

    }



    public function testIsIntDoesNotThrowOnInt()
    {
        $value = 42;
        Assert::that($value, 'testValue')->isInt()->isStrictInt();
        $this->assertTrue(true);
    }

    public function testIsIntDoesNotThrowOnIntString()
    {
        $value = '42';
        Assert::that($value, 'testValue')->isInt();
        $this->assertTrue(true);
    }

    public function testIsStrictIntThrowsOnIntString()
    {
        $this->expectException(AssertException::class);
        $this->expectExceptionMessage('Expected testValue to be strictly an integer, got string(\'42\')');

        $value = '42';
        Assert::that($value, 'testValue')->isStrictInt();
    }

    public function testIsFloatAcceptsFloat()
    {
        $value = 3.14;
        Assert::that($value, 'testValue')->isFloat();
        $this->assertTrue(true);
    }

    public function testIsFloatAcceptsFloatString()
    {
        $value = '3.14';
        Assert::that($value, 'testValue')->isFloat();
        $this->assertTrue(true);
    }

    public function testIsFloatRejectsNonFloatString()
    {
        $this->expectException(AssertException::class);
        $this->expectExceptionMessage('Expected testValue to be numeric, got string(\'not a float\')');

        $value = 'not a float';
        Assert::that($value, 'testValue')->isFloat();
    }

    public function testIsStrictFloatAcceptsOnlyRealFloat()
    {
        $value = 3.14;
        Assert::that($value, 'testValue')->isStrictFloat();
        $this->assertTrue(true);
    }

    public function testIsStrictFloatThrowsOnFloatString()
    {
        $this->expectException(AssertException::class);
        $this->expectExceptionMessage('Expected testValue to be strictly a float, got string(\'3.14\')');

        $value = '3.14';
        Assert::that($value, 'testValue')->isStrictFloat();
    }

    public function testIsStrictFloatThrowsOnInteger()
    {
        $this->expectException(AssertException::class);
        $this->expectExceptionMessage('Expected testValue to be strictly a float, got integer(\'42\')');

        $value = 42;
        Assert::that($value, 'testValue')->isStrictFloat();
    }

    public function testIsGreatherThanTrue()
    {
        $value = '42.6';
        Assert::that($value, 'testValue')->isGreaterThan(42);

        $this->assertTrue(true);
    }

    public function testIsGreatherThanFalse()
    {
        $this->expectException(AssertException::class);
        $this->expectExceptionMessage('Expected testValue to be greater than 42, got string(\'41\')');

        $value = '41';
        Assert::that($value, 'testValue')->isGreaterThan(42);
    }
}
