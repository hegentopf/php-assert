<?php
namespace Hegentopf\Assert\Tests;

use function PHPUnit\Framework\assertInstanceOf;
use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;

class ArrayLoopAssertionsTest extends TestCase
{
    public function testEachWithObjects()
    {
        $obj1  = new stdClass();
        $obj2  = new stdClass();
        $array = [$obj1, $obj2];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->each()->isObject());
    }

    public function testEachWithInts()
    {
        $array = [1, 2, 3];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->each()->isInt());
    }

    public function testEachWithNestedArrays()
    {
        $array = [[1, 2], [3, 4]];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->each()->isArray());
        Assert::that($array)->isArray()->each()->hasArrayLength(2);
    }

    public function testEachRecursiveWithInts()
    {
        $array = [[1, 2], [3, 4]];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->eachRecursive()->isInt());
    }

    public function testEachRecursiveWithArrayAssertions()
    {
        $array = [[[1], [2]], [[3]]];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->eachRecursive()->hasArrayLengthBetween(0, 2));
    }

    public function testEachRecursiveWithArrayAndValueAssertions()
    {
        $array = [[[1], [2]], [[3]]];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->eachRecursive()->hasArrayLengthBetween(0, 2)->isInt());
    }

    public function testEachWithEmptySubarrays()
    {
        $array = [[], []];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->each()->isArray());
        Assert::that($array)->isArray()->each()->hasArrayLength(0);
        Assert::that($array)->isArray()->each()->hasMaxArrayLength(0);
        Assert::that($array)->isArray()->each()->hasMinArrayLength(0);
    }

    public function testEachArrayLengthBetween()
    {
        $array = [
            [1, 2],
            [3, 4, 5],
            [6, 7, 8, 9],
        ];
        Assert::that($array)->isArray()->each()->hasArrayLengthBetween(2, 4);
        $this->expectException(AssertException::class);
        Assert::that($array)->isArray()->each()->hasArrayLengthBetween(2, 3);
    }

    public function testEachRecursiveWithMixedTypesThrows()
    {
        $this->expectException(AssertException::class);
        $array = [
            [1, 2],
            [3, 'fail'],
        ];
        Assert::that($array)->isArray()->eachRecursive()->isInt();
    }

    public function testEachRecursiveWithNestedOptional()
    {
        $array = [
            [null, 3.14],
            [2.71, null],
        ];
        assertInstanceOf(Assert::class, Assert::that($array)->isArray()->eachRecursive()->isOptional()->isStrictFloat());
    }

    public function testEachWithObject()
    {
        $obj1         = new stdClass();
        $obj1->value1 = 1;
        $obj1->value2 = 2;
        assertInstanceOf(Assert::class, Assert::that($obj1)->each()->isInt());
    }

    public function testEachRecursiveWithObject()
    {
        $obj1         = new stdClass();
        $obj1->value1 = 1;
        $obj1->value2 = 2;
        assertInstanceOf(Assert::class, Assert::that([[$obj1]])->eachRecursive()->isInt());
    }

    public function testEachRecursiveWithArrayInObject()
    {
        $obj1         = new stdClass();
        $obj1->value1 = [1];
        $obj1->value2 = 2;
        $obj1->value3 = [[2]];
        assertInstanceOf(Assert::class, Assert::that([[$obj1]])->eachRecursive()->isInt());
    }
}
