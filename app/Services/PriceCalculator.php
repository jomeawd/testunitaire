<?php

namespace App\Services;

use InvalidArgumentException;

class PriceCalculator
{
    private const TAXES = [
        'UT' => 0.0685,
        'NV' => 0.08,
        'TX' => 0.0625,
        'AL' => 0.04,
        'CA' => 0.0825,
    ];

    public static function calculate(float $unitPrice, int $quantity, string $state): float
    {
        if ($quantity <= 0) {
            return 0;
        }

        if (!array_key_exists($state, self::TAXES)) {
            throw new InvalidArgumentException("Etat inconnu");
        }

        // Prix HT
        $total = $unitPrice * $quantity;

        // Réduction avant TVA
        $discount = 0;

        if ($total >= 50000) {
            $discount = 0.15;
        } elseif ($total >= 10000) {
            $discount = 0.10;
        } elseif ($total >= 7000) {
            $discount = 0.07;
        } elseif ($total >= 5000) {
            $discount = 0.05;
        } elseif ($total >= 1000) {
            $discount = 0.03;
        }

        $total = $total * (1 - $discount);

        // Application de la TVA
        $total = $total * (1 + self::TAXES[$state]);

        return round($total, 2);
    }
}