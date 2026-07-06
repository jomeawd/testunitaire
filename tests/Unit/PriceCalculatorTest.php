<?php

namespace Tests\Unit;

use App\Services\PriceCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    public function test_one_item_in_ut()
    {
        $this->assertEquals(
            10.69,
            PriceCalculator::calculate(10, 1, 'UT')
        );
    }

    public function test_one_item_in_ca()
    {
        $this->assertEquals(
            10.83,
            PriceCalculator::calculate(10, 1, 'CA')
        );
    }

    public function test_one_item_in_tx()
    {
        $this->assertEquals(
            10.63,
            PriceCalculator::calculate(10, 1, 'TX')
        );
    }

    public function test_zero_quantity()
    {
        $this->assertEquals(
            0,
            PriceCalculator::calculate(10, 0, 'CA')
        );
    }

    public function test_discount_three_percent()
    {
        $this->assertEquals(
            1050.03,
            PriceCalculator::calculate(100, 10, 'CA')
        );
    }

    public function test_discount_five_percent()
    {
        $this->assertEquals(
            5046.88,
            PriceCalculator::calculate(500, 10, 'TX')
        );
    }

    public function test_discount_seven_percent()
    {
        $this->assertEquals(
            6770.40,
            PriceCalculator::calculate(700, 10, 'AL')
        );
    }

    public function test_discount_ten_percent()
    {
        $this->assertEquals(
            9720.00,
            PriceCalculator::calculate(1000, 10, 'NV')
        );
    }

    public function test_discount_fifteen_percent()
    {
        $this->assertEquals(
            46006.25,
            PriceCalculator::calculate(5000, 10, 'CA')
        );
    }

    public function test_invalid_state()
    {
        $this->expectException(InvalidArgumentException::class);

        PriceCalculator::calculate(100, 10, 'FR');
    }
}