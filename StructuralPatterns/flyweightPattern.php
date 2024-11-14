<?php

class FurnitureFlyweight {
    private string $type;
    private string $material;
    private string $color;
    private string $style;

    public function __construct(string $type, string $material, string $color, string $style) {
        $this->type = $type;
        $this->material = $material;
        $this->color = $color;
        $this->style = $style;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDetails(): string {
        return "Type: {$this->type}, Material: {$this->material}, Color: {$this->color}, Style: {$this->style}";
    }
}

class FurnitureFlyweightFactory {
    private array $flyweights = [];

    public function getFlyweight(string $type, string $material, string $color, string $style): FurnitureFlyweight {
        $key = md5($type . $material . $color . $style);

        if (!isset($this->flyweights[$key])) {
            echo "Creating new Flyweight for [$type, $material, $color, $style].\n";
            $this->flyweights[$key] = new FurnitureFlyweight($type, $material, $color, $style);
        } else {
            echo "Reusing existing Flyweight for [$type, $material, $color, $style].\n";
        }

        return $this->flyweights[$key];
    }

    public function getFlyweightCount(): int {
        return count($this->flyweights);
    }
}

class FurnitureItem {
    private FurnitureFlyweight $flyweight;
    private string $position;
    private string $customLabel;

    public function __construct(FurnitureFlyweight $flyweight, string $position, string $customLabel) {
        $this->flyweight = $flyweight;
        $this->position = $position;
        $this->customLabel = $customLabel;
    }

    public function display(): void {
        echo "Furniture Item [Position: {$this->position}, Label: {$this->customLabel}]\n";
        echo "  - " . $this->flyweight->getDetails() . "\n";
    }
}

function clientCode() {
    $factory = new FurnitureFlyweightFactory();

    // Create individual furniture items
    $chair1 = new FurnitureItem(
        $factory->getFlyweight("Chair", "Wood", "Brown", "Modern"),
        "Living Room", 
        "Main Chair"
    );

    $sofa1 = new FurnitureItem(
        $factory->getFlyweight("Sofa", "Leather", "Black", "Contemporary"),
        "Living Room", 
        "Primary Sofa"
    );

    $chair2 = new FurnitureItem(
        $factory->getFlyweight("Chair", "Wood", "Brown", "Modern"),
        "Dining Room", 
        "Side Chair"
    );

    $coffeeTable = new FurnitureItem(
        $factory->getFlyweight("Coffee Table", "Glass", "Transparent", "Modern"),
        "Living Room", 
        "Center Table"
    );

    // Display details for each item
    $chair1->display();
    $sofa1->display();
    $chair2->display();
    $coffeeTable->display();

    // Show the number of unique flyweights created
    echo "Total unique flyweights created: " . $factory->getFlyweightCount() . "\n";
}

clientCode();