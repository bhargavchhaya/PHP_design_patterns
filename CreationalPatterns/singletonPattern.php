<?php

class FurnitureInventory {
    private static ?FurnitureInventory $instance = null;
    private array $inventory = [];

    // Private constructor to prevent instantiation from outside
    private function __construct() {
        // Initialize with some default furniture items
        $this->inventory['Chair'] = [];
        $this->inventory['Sofa'] = [];
        $this->inventory['CoffeeTable'] = [];
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    private function __wakeup() {}

    // Static method to access the singleton instance
    public static function getInstance(): FurnitureInventory {
        if (self::$instance === null) {
            self::$instance = new FurnitureInventory();
        }
        return self::$instance;
    }

    // Method to add a furniture item to the inventory
    public function addFurniture(string $type, string $item): void {
        if (array_key_exists($type, $this->inventory)) {
            $this->inventory[$type][] = $item;
        } else {
            echo "Invalid furniture type: $type\n";
        }
    }

    // Method to get all furniture items of a certain type
    public function getFurniture(string $type): array {
        return $this->inventory[$type] ?? [];
    }

    // Method to display the entire inventory
    public function showInventory(): void {
        echo "Furniture Inventory:\n";
        foreach ($this->inventory as $type => $items) {
            echo "- $type:\n";
            foreach ($items as $item) {
                echo "    * $item\n";
            }
        }
    }
}

function clientCode() {
    // Get the singleton instance
    $inventory = FurnitureInventory::getInstance();

    // Add furniture items
    $inventory->addFurniture('Chair', 'Victorian Chair');
    $inventory->addFurniture('Chair', 'Modern Chair');
    $inventory->addFurniture('Sofa', 'Victorian Sofa');
    $inventory->addFurniture('Sofa', 'Modern Sofa');
    $inventory->addFurniture('CoffeeTable', 'Victorian Coffee Table');
    $inventory->addFurniture('CoffeeTable', 'Modern Coffee Table');

    // Display inventory
    $inventory->showInventory();

    // Attempt to create a second reference to the singleton
    $secondInventory = FurnitureInventory::getInstance();
    echo "\nChecking if both inventory references are the same instance:\n";
    echo $inventory === $secondInventory ? "Yes, they are the same instance.\n" : "No, they are different instances.\n";
}

clientCode();