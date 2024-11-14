<?php

interface PricingStrategy {
    public function calculatePrice(FurnitureItem $item): float;
}

class FurnitureItem {
    private $name;
    private $basePrice;
    private $pricingStrategy;

    public function __construct($name, float $basePrice, PricingStrategy $strategy = null) {
        $this->name = $name;
        $this->basePrice = $basePrice;
        $this->pricingStrategy = $strategy ?: new MaterialBasedPricing(); // Default strategy
    }

    // Set the pricing strategy
    public function setPricingStrategy(PricingStrategy $strategy): void {
        $this->pricingStrategy = $strategy;
    }

    // Calculate the price using the current strategy
    public function calculatePrice(): float {
        if ($this->pricingStrategy === null) {
            throw new Exception("Pricing strategy is not set.");
        }
        return $this->pricingStrategy->calculatePrice($this);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBasePrice(): float {
        return $this->basePrice;
    }
}

class MaterialBasedPricing implements PricingStrategy {

    public function calculatePrice(FurnitureItem $item): float {
        $materialPrice = 0;

        // Simulate price adjustment based on material (e.g., Wood, Metal)
        if ($item->getName() == "Chair") {
            $materialPrice = $item->getBasePrice() * 1.2; // Assume wood-based material for Chair
        } elseif ($item->getName() == "Sofa") {
            $materialPrice = $item->getBasePrice() * 1.5; // Assume fabric-based material for Sofa
        } elseif ($item->getName() == "Coffee Table") {
            $materialPrice = $item->getBasePrice() * 1.1; // Assume wood-based material for Coffee Table
        }

        return $materialPrice;
    }
}

class SizeBasedPricing implements PricingStrategy {

    public function calculatePrice(FurnitureItem $item): float {
        $sizePriceFactor = 1.0;

        // Simulate price adjustment based on size (e.g., small, medium, large)
        if ($item->getName() == "Chair") {
            $sizePriceFactor = 1.1; // Chair is small
        } elseif ($item->getName() == "Sofa") {
            $sizePriceFactor = 1.5; // Sofa is large
        } elseif ($item->getName() == "Coffee Table") {
            $sizePriceFactor = 1.2; // Coffee Table is medium
        }

        return $item->getBasePrice() * $sizePriceFactor;
    }
}

class DiscountBasedPricing implements PricingStrategy {

    public function calculatePrice(FurnitureItem $item): float {
        $discount = 0;

        // Simulate a 10% discount for all items
        $discount = 0.1;

        return $item->getBasePrice() * (1 - $discount);
    }
}

function clientCode() {
    // Create furniture items with base prices
    $chair = new FurnitureItem("Chair", 100.00);
    $sofa = new FurnitureItem("Sofa", 500.00);
    $coffeeTable = new FurnitureItem("Coffee Table", 150.00);

    // Set the pricing strategy for each item (if not set during construction)
    echo $chair->getName() . " price using Material-Based Pricing: $" . $chair->calculatePrice() . "\n";
    $chair->setPricingStrategy(new SizeBasedPricing());  // Set new pricing strategy
    echo $chair->getName() . " price using Size-Based Pricing: $" . $chair->calculatePrice() . "\n";
    $chair->setPricingStrategy(new DiscountBasedPricing());  // Set another pricing strategy
    echo $chair->getName() . " price using Discount-Based Pricing: $" . $chair->calculatePrice() . "\n";

    echo "\n";

    // Sofa example with Material-Based Pricing strategy
    $sofa->setPricingStrategy(new MaterialBasedPricing());
    echo $sofa->getName() . " price using Material-Based Pricing: $" . $sofa->calculatePrice() . "\n";

    // Coffee Table example with Discount-Based Pricing strategy
    $coffeeTable->setPricingStrategy(new DiscountBasedPricing());
    echo $coffeeTable->getName() . " price using Discount-Based Pricing: $" . $coffeeTable->calculatePrice() . "\n";
}

clientCode();