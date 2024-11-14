<?php

interface Furniture {
    public function getDescription(): string;
}

class Chair implements Furniture {
    public function __construct() {
        // Simulate a resource-intensive creation process
        echo "Creating a new Chair (takes time)\n";
        sleep(2);  // Simulating a delay
    }

    public function getDescription(): string {
        return "This is a Chair.";
    }
}

class Sofa implements Furniture {
    public function __construct() {
        // Simulate a resource-intensive creation process
        echo "Creating a new Sofa (takes time)\n";
        sleep(3);  // Simulating a delay
    }

    public function getDescription(): string {
        return "This is a Sofa.";
    }
}

class CoffeeTable implements Furniture {
    public function __construct() {
        // Simulate a resource-intensive creation process
        echo "Creating a new Coffee Table (takes time)\n";
        sleep(1);  // Simulating a delay
    }

    public function getDescription(): string {
        return "This is a Coffee Table.";
    }
}

class FurnitureProxy implements Furniture {
    private string $type;
    private ?Furniture $furniture = null;

    public function __construct(string $type) {
        $this->type = $type;
    }

    private function initialize(): void {
        if ($this->furniture === null) {
            switch ($this->type) {
                case 'Chair':
                    $this->furniture = new Chair();
                    break;
                case 'Sofa':
                    $this->furniture = new Sofa();
                    break;
                case 'CoffeeTable':
                    $this->furniture = new CoffeeTable();
                    break;
                default:
                    throw new Exception("Unknown furniture type: {$this->type}");
            }
        }
    }

    public function getDescription(): string {
        $this->initialize();  // Lazy initialization
        return $this->furniture->getDescription();
    }
}

function clientCode() {
    // Create proxies for various furniture types
    $chairProxy = new FurnitureProxy("Chair");
    $sofaProxy = new FurnitureProxy("Sofa");
    $coffeeTableProxy = new FurnitureProxy("CoffeeTable");

    echo "Furniture proxies created, but real furniture objects are not initialized yet.\n\n";

    // Accessing descriptions - objects will be created lazily
    echo $chairProxy->getDescription() . "\n";
    echo $sofaProxy->getDescription() . "\n";
    echo $coffeeTableProxy->getDescription() . "\n";
}

clientCode();