<?php

interface State {
    public function applyDiscount(FurnitureItem $item): void;
    public function getPrice(FurnitureItem $item): float;
}

class FurnitureItem {
    private $name;
    private $price;
    private $state;

    public function __construct($name, float $price) {
        $this->name = $name;
        $this->price = $price;
        $this->state = new AvailableState(); // Default state is Available
    }

    public function setState(State $state): void {
        $this->state = $state;
    }

    public function applyDiscount(): void {
        $this->state->applyDiscount($this);
    }

    public function getPrice(): float {
        return $this->state->getPrice($this);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getRawPrice(): float {
        return $this->price;
    }
}

class AvailableState implements State {

    public function applyDiscount(FurnitureItem $item): void {
        echo $item->getName() . " is available for purchase. No discount applied.\n";
    }

    public function getPrice(FurnitureItem $item): float {
        return $item->getRawPrice();
    }
}

class SoldState implements State {

    public function applyDiscount(FurnitureItem $item): void {
        echo $item->getName() . " is sold. No discount can be applied.\n";
    }

    public function getPrice(FurnitureItem $item): float {
        return 0;  // Item is sold, no price
    }
}

class OnSaleState implements State {

    public function applyDiscount(FurnitureItem $item): void {
        echo $item->getName() . " is on sale. Applying 20% discount.\n";
    }

    public function getPrice(FurnitureItem $item): float {
        return $item->getRawPrice() * 0.8;  // 20% discount
    }
}

function clientCode() {
    // Create furniture items with initial prices
    $chair = new FurnitureItem("Chair", 100.00);
    $sofa = new FurnitureItem("Sofa", 500.00);
    $coffeeTable = new FurnitureItem("Coffee Table", 150.00);

    // Initially, all items are available
    echo $chair->getName() . " Price: $" . $chair->getPrice() . "\n";
    $chair->applyDiscount();  // No discount, item is available

    echo $sofa->getName() . " Price: $" . $sofa->getPrice() . "\n";
    $sofa->applyDiscount();  // No discount, item is available

    echo $coffeeTable->getName() . " Price: $" . $coffeeTable->getPrice() . "\n";
    $coffeeTable->applyDiscount();  // No discount, item is available

    // Change the state to "On Sale" for the chair
    $chair->setState(new OnSaleState());
    echo "\nState changed: " . $chair->getName() . " Price: $" . $chair->getPrice() . "\n";
    $chair->applyDiscount();  // Discount applied

    // Change the state to "Sold" for the sofa
    $sofa->setState(new SoldState());
    echo "\nState changed: " . $sofa->getName() . " Price: $" . $sofa->getPrice() . "\n";
    $sofa->applyDiscount();  // No discount, item is sold
}

clientCode();

