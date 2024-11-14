<?php

interface FurnitureVisitor {
    public function visitChair(Chair $chair);
    public function visitSofa(Sofa $sofa);
    public function visitCoffeeTable(CoffeeTable $coffeeTable);
}

interface FurnitureItem {
    public function accept(FurnitureVisitor $visitor);
    public function getBasePrice(): float;
    public function getName(): string;
}

class Chair implements FurnitureItem {
    private $name;
    private $basePrice;

    public function __construct($name, float $basePrice) {
        $this->name = $name;
        $this->basePrice = $basePrice;
    }

    public function accept(FurnitureVisitor $visitor) {
        $visitor->visitChair($this);
    }

    public function getBasePrice(): float {
        return $this->basePrice;
    }

    public function getName(): string {
        return $this->name;
    }
}

class Sofa implements FurnitureItem {
    private $name;
    private $basePrice;

    public function __construct($name, float $basePrice) {
        $this->name = $name;
        $this->basePrice = $basePrice;
    }

    public function accept(FurnitureVisitor $visitor) {
        $visitor->visitSofa($this);
    }

    public function getBasePrice(): float {
        return $this->basePrice;
    }

    public function getName(): string {
        return $this->name;
    }
}

class CoffeeTable implements FurnitureItem {
    private $name;
    private $basePrice;

    public function __construct($name, float $basePrice) {
        $this->name = $name;
        $this->basePrice = $basePrice;
    }

    public function accept(FurnitureVisitor $visitor) {
        $visitor->visitCoffeeTable($this);
    }

    public function getBasePrice(): float {
        return $this->basePrice;
    }

    public function getName(): string {
        return $this->name;
    }
}

class PriceCalculator implements FurnitureVisitor {
    public function visitChair(Chair $chair) {
        echo $chair->getName() . " price: $" . $chair->getBasePrice() * 1.2 . "\n"; // Material-based price for chair
    }

    public function visitSofa(Sofa $sofa) {
        echo $sofa->getName() . " price: $" . $sofa->getBasePrice() * 1.5 . "\n"; // Material-based price for sofa
    }

    public function visitCoffeeTable(CoffeeTable $coffeeTable) {
        echo $coffeeTable->getName() . " price: $" . $coffeeTable->getBasePrice() * 1.1 . "\n"; // Material-based price for coffee table
    }
}

class DiscountApplier implements FurnitureVisitor {
    public function visitChair(Chair $chair) {
        echo $chair->getName() . " with discount: $" . $chair->getBasePrice() * 0.9 . "\n"; // 10% discount
    }

    public function visitSofa(Sofa $sofa) {
        echo $sofa->getName() . " with discount: $" . $sofa->getBasePrice() * 0.85 . "\n"; // 15% discount
    }

    public function visitCoffeeTable(CoffeeTable $coffeeTable) {
        echo $coffeeTable->getName() . " with discount: $" . $coffeeTable->getBasePrice() * 0.8 . "\n"; // 20% discount
    }
}

function clientCode() {
    // Create furniture items with base prices
    $chair = new Chair("Chair", 100.00);
    $sofa = new Sofa("Sofa", 500.00);
    $coffeeTable = new CoffeeTable("Coffee Table", 150.00);

    // Create the visitors
    $priceCalculator = new PriceCalculator();
    $discountApplier = new DiscountApplier();

    // Apply the PriceCalculator visitor
    echo "Price Calculation:\n";
    $chair->accept($priceCalculator);
    $sofa->accept($priceCalculator);
    $coffeeTable->accept($priceCalculator);

    echo "\n";

    // Apply the DiscountApplier visitor
    echo "Discount Application:\n";
    $chair->accept($discountApplier);
    $sofa->accept($discountApplier);
    $coffeeTable->accept($discountApplier);
}

clientCode();