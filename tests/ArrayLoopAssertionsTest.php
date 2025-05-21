<?php

namespace Hegentopf\Assert\Tests;

use Hegentopf\Assert\Assert;
use Hegentopf\Assert\AssertException;
use PHPUnit\Framework\TestCase;
use stdClass;
use function PHPUnit\Framework\assertInstanceOf;

class ArrayLoopAssertionsTest extends TestCase {
   public function testAssertThatEachWithObjects()
    {
        $obj1 = new stdClass();
        $obj2 = new stdClass();
        $array = [ $obj1, $obj2 ];
        assertInstanceOf( Assert::class, Assert::that( $array )->isArray()->each()->isObject() );
    }

    public function testAssertThatEachWithNestedOptional()
    {
        $array = [
            [null, 3.14],
            [2.71, null]
        ];
        assertInstanceOf( Assert::class, Assert::that( $array )->isArray()->eachRecursive()->isOptional()->isStrictFloat() );
    }

    public function testAssertThatEachArrayLength()
    {
        $array = [
            [1, 2],
            [3, 4, 5]
        ];
        assertInstanceOf( Assert::class, Assert::that($array)->isArray()->each()->isArray() );
        Assert::that( $array )->isArray()->each()->hasMinArrayLength( 2 );
        Assert::that( $array )->isArray()->each()->hasMaxArrayLength( 3 );
        Assert::that( $array[0] )->isArray()->hasArrayLength( 2 );
        Assert::that( $array[1] )->isArray()->hasArrayLength( 3 );
    }

    public function testAssertThatEachRecursiveWithInts()
    {
        $array = [
            [1, 2],
            [3, 4]
        ];
        assertInstanceOf( Assert::class, Assert::that( $array )->isArray()->eachRecursive()->isInt() );
    }

    public function testAssertThatEachRecursiveWithMixedTypesThrows()
    {
        $this->expectException( AssertException::class );
        $array = [
            [1, 2],
            [3, 'fail']
        ];
        Assert::that( $array )->isArray()->eachRecursive()->isInt();
    }

    public function testAssertThatEachWithEmptySubarrays()
    {
        $array = [
            [],
            []
        ];
        assertInstanceOf( Assert::class, Assert::that( $array )->isArray()->each()->isArray() );
        Assert::that( $array )->isArray()->each()->hasArrayLength( 0 );
        Assert::that( $array )->isArray()->each()->hasMaxArrayLength( 0 );
        Assert::that( $array )->isArray()->each()->hasMinArrayLength( 0 );
    }

    public function testAssertThatEachArrayLengthBetween()
    {
        $array = [
            [1, 2],
            [3, 4, 5],
            [6, 7, 8, 9]
        ];
        
        Assert::that( $array )->isArray()->each()->hasArrayLengthBetween( 2, 4 );
        $this->expectException( AssertException::class );
        Assert::that( $array )->isArray()->each()->hasArrayLengthBetween( 2, 3 );

    }
}
