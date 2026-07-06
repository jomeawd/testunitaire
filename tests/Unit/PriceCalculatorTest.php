<?php

namespace Tests\Unit;

use App\Services\PriceCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    /**
     * Vérifie le calcul pour un seul article.
     */
    public function test_price_of_one_item(): void
    {
        $this->assertEquals(
            10,
            PriceCalculator::calculate(10, 1)
        );
    }

    /**
     * Vérifie le calcul pour plusieurs articles.
     */
    public function test_price_of_five_items(): void
    {
        $this->assertEquals(
            50,
            PriceCalculator::calculate(10, 5)
        );
    }

    /**
     * Vérifie le calcul avec un prix unitaire décimal.
     */
    public function test_price_with_decimal_unit_price(): void
    {
        $this->assertEquals(
            37.5,
            PriceCalculator::calculate(7.5, 5)
        );
    }

    /**
     * Vérifie le calcul lorsque la quantité est nulle.
     */
    public function test_zero_quantity(): void
    {
        $this->assertEquals(
            0,
            PriceCalculator::calculate(10, 0)
        );
    }

    /**
     * Un prix unitaire à zéro donne un total nul.
     */
    public function test_zero_unit_price(): void
    {
        $this->assertEquals(
            0,
            PriceCalculator::calculate(0, 5)
        );
    }

    /**
     * Vérifie le calcul avec une grande quantité.
     */
    public function test_large_quantity(): void
    {
        $this->assertEquals(
            2000,
            PriceCalculator::calculate(2, 1000)
        );
    }

    /**
     * Vérifie un calcul dont le résultat est décimal.
     */
    public function test_decimal_price_and_result(): void
    {
        $this->assertEquals(
            59.97,
            PriceCalculator::calculate(19.99, 3)
        );
    }

    /**
     * Un prix et une quantité nuls donnent zéro.
     */
    public function test_zero_price_and_zero_quantity(): void
    {
        $this->assertEquals(
            0,
            PriceCalculator::calculate(0, 0)
        );
    }

    /**
     * Une quantité négative doit être refusée.
     */
    public function test_negative_quantity_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        PriceCalculator::calculate(10, -2);
    }

    /**
     * Un prix unitaire négatif doit être refusé.
     */
    public function test_negative_unit_price_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        PriceCalculator::calculate(-5, 2);
    }
}