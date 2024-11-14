<?php

class FurnitureItem {
    private string $type;
    private float $price;

    public function __construct(string $type, float $price) {
        $this->type = $type;
        $this->price = $price;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPrice(): float {
        return $this->price;
    }
}

class FurnitureCollection implements Iterator {
    private array $items = [];
    private int $position = 0;

    public function __construct() {
        $this->position = 0;
    }

    // Method to add a furniture item to the collection
    public function addItem(FurnitureItem $item): void {
        $this->items[] = $item;
    }

    // Iterator interface methods
    public function current(): FurnitureItem {
        return $this->items[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        $this->position++;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function valid(): bool {
        return isset($this->items[$this->position]);
    }
}


function clientCode() {
    // Create a new furniture collection
    $collection = new FurnitureCollection();

    // Add items to the collection
    $collection->addItem(new FurnitureItem("Chair", 150.00));
    $collection->addItem(new FurnitureItem("Sofa", 550.00));
    $collection->addItem(new FurnitureItem("Coffee Table", 120.00));

    // Iterate through the collection and display each item
    echo "Furniture Collection:\n";
    foreach ($collection as $item) {
        echo "Item: " . $item->getType() . ", Price: $" . $item->getPrice() . "\n";
    }
}

clientCode();