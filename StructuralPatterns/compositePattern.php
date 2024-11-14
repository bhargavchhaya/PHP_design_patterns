<?php

interface FurnitureComponent {
    public function getName(): string;
    public function showDetails(): void;
}

class Chair implements FurnitureComponent {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function showDetails(): void {
        echo "Chair: " . $this->getName() . "\n";
    }
}

class Sofa implements FurnitureComponent {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function showDetails(): void {
        echo "Sofa: " . $this->getName() . "\n";
    }
}

class CoffeeTable implements FurnitureComponent {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function showDetails(): void {
        echo "Coffee Table: " . $this->getName() . "\n";
    }
}

class FurnitureSet implements FurnitureComponent {
    private string $name;
    private array $furnitureItems = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function add(FurnitureComponent $furniture): void {
        $this->furnitureItems[] = $furniture;
    }

    public function remove(FurnitureComponent $furniture): void {
        $this->furnitureItems = array_filter(
            $this->furnitureItems,
            fn($item) => $item !== $furniture
        );
    }

    public function showDetails(): void {
        echo "Furniture Set: " . $this->getName() . "\n";
        foreach ($this->furnitureItems as $item) {
            echo "  - ";
            $item->showDetails();
        }
    }
}

function clientCode() {
    // Create individual furniture items
    $chair1 = new Chair("Modern Chair");
    $sofa1 = new Sofa("Leather Sofa");
    $coffeeTable1 = new CoffeeTable("Glass Coffee Table");

    // Create a furniture set for the living room
    $livingRoomSet = new FurnitureSet("Living Room Set");
    $livingRoomSet->add($chair1);
    $livingRoomSet->add($sofa1);
    $livingRoomSet->add($coffeeTable1);

    // Create individual items for a second set
    $chair2 = new Chair("Victorian Chair");
    $coffeeTable2 = new CoffeeTable("Wooden Coffee Table");

    // Create a furniture set for the study room
    $studyRoomSet = new FurnitureSet("Study Room Set");
    $studyRoomSet->add($chair2);
    $studyRoomSet->add($coffeeTable2);

    // Create a complete home furniture set that includes other sets
    $homeFurniture = new FurnitureSet("Home Furniture Set");
    $homeFurniture->add($livingRoomSet);
    $homeFurniture->add($studyRoomSet);

    // Display all furniture in the home furniture set
    $homeFurniture->showDetails();
}

clientCode();