<?php

abstract class FurnitureItem {
    private $name;
    private $basePrice;

    public function __construct($name, float $basePrice) {
        $this->name = $name;
        $this->basePrice = $basePrice;
    }

    // Template method
    public final function calculatePrice(): float {
        $price = $this->basePrice;

        // Step 1: Apply material adjustment
        $price = $this->applyMaterialAdjustment($price);

        // Step 2: Apply size adjustment
        $price = $this->applySizeAdjustment($price);

        // Step 3: Apply discount
        $price = $this->applyDiscount($price);

        // Final step: Apply tax
        return $this->applyTax($price);
    }

    // Step 1: Material adjustment (each subclass implements this differently)
    abstract protected function applyMaterialAdjustment(float $price): float;

    // Step 2: Size adjustment (each subclass implements this differently)
    abstract protected function applySizeAdjustment(float $price): float;

    // Step 3: Discount (all subclasses use the same discount, so no need to override)
    protected function applyDiscount(float $price): float {
        // Apply a 10% discount to all furniture items
        return $price * 0.90;
    }

    // Step 4: Apply tax (all subclasses use the same tax calculation)
    protected function applyTax(float $price): float {
        // Apply 5% tax
        return $price * 1.05;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBasePrice(): float {
        return $this->basePrice;
    }
}

class Chair extends FurnitureItem {
    // Step 1: Apply material adjustment
    protected function applyMaterialAdjustment(float $price): float {
        // Assume wood-based material for Chair
        return $price * 1.2;
    }

    // Step 2: Apply size adjustment
    protected function applySizeAdjustment(float $price): float {
        // Assume chair is small, no size adjustment
        return $price;
    }
}

class Sofa extends FurnitureItem {
    // Step 1: Apply material adjustment
    protected function applyMaterialAdjustment(float $price): float {
        // Assume fabric-based material for Sofa
        return $price * 1.5;
    }

    // Step 2: Apply size adjustment
    protected function applySizeAdjustment(float $price): float {
        // Sofa is large, apply a size adjustment
        return $price * 1.3;
    }
}

class CoffeeTable extends FurnitureItem {
    // Step 1: Apply material adjustment
    protected function applyMaterialAdjustment(float $price): float {
        // Assume wood-based material for Coffee Table
        return $price * 1.1;
    }

    // Step 2: Apply size adjustment
    protected function applySizeAdjustment(float $price): float {
        // Coffee table is medium-sized, apply a medium adjustment
        return $price * 1.2;
    }
}

function clientCode() {
    // Create furniture items with base prices
    $chair = new Chair("Chair", 100.00);
    $sofa = new Sofa("Sofa", 500.00);
    $coffeeTable = new CoffeeTable("Coffee Table", 150.00);

    // Calculate price using the template method
    echo $chair->getName() . " price: $" . $chair->calculatePrice() . "\n";
    echo $sofa->getName() . " price: $" . $sofa->calculatePrice() . "\n";
    echo $coffeeTable->getName() . " price: $" . $coffeeTable->calculatePrice() . "\n";
}

clientCode();