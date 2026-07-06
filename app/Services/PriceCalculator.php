<?php

namespace App\Services;

use InvalidArgumentException;

class PriceCalculator
{
    /**
     * Calcule le prix brut d'une commande.
     *
     * @param float $unitPrice Prix unitaire
     * @param int $quantity Nombre d'articles
     * @return float Prix total
     *
     * @throws InvalidArgumentException Si le prix ou la quantité est négatif.
     */
    public static function calculate(float $unitPrice, int $quantity): float
    {
        if ($unitPrice < 0) {
            throw new InvalidArgumentException('Le prix unitaire ne peut pas être négatif.');
        }

        if ($quantity < 0) {
            throw new InvalidArgumentException('La quantité ne peut pas être négative.');
        }

        return $unitPrice * $quantity;
    }
}