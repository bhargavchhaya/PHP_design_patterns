<?php

interface FurniturePrototype {
    public function __clone();
}

class Chair implements FurniturePrototype {
    public string $material;
    public string $color;
    public string $dimensions;

    public function __construct(string $material, string $color, string $dimensions) {
        $this->material = $material;
        $this->color = $color;
        $this->dimensions = $dimensions;
    }

    public function __clone() {
        // Perform any deep copy operations if necessary
    }

    public function showDetails(): void {
        echo "Chair [Material: {$this->material}, Color: {$this->color}, Dimensions: {$this->dimensions}]\n";
    }
}

class Sofa implements FurniturePrototype {
    public string $material;
    public string $color;
    public string $dimensions;

    public function __construct(string $material, string $color, string $dimensions) {
        $this->material = $material;
        $this->color = $color;
        $this->dimensions = $dimensions;
    }

    public function __clone() {
        // Perform any deep copy operations if necessary
    }

    public function showDetails(): void {
        echo "Sofa [Material: {$this->material}, Color: {$this->color}, Dimensions: {$this->dimensions}]\n";
    }
}

class CoffeeTable implements FurniturePrototype {
    public string $material;
    public string $color;
    public string $dimensions;

    public function __construct(string $material, string $color, string $dimensions) {
        $this->material = $material;
        $this->color = $color;
        $this->dimensions = $dimensions;
    }

    public function __clone() {
        // Perform any deep copy operations if necessary
    }

    public function showDetails(): void {
        echo "Coffee Table [Material: {$this->material}, Color: {$this->color}, Dimensions: {$this->dimensions}]\n";
    }
}

class FurniturePrototypeManager {
    private array $prototypes = [];

    public function __construct() {
        // Initialize prototypes
        $this->prototypes['VictorianChair'] = new Chair("Wood", "Mahogany", "40x40x90 cm");
        $this->prototypes['ModernChair'] = new Chair("Metal", "Black", "40x40x85 cm");
        
        $this->prototypes['VictorianSofa'] = new Sofa("Wood", "Brown", "200x90x100 cm");
        $this->prototypes['ModernSofa'] = new Sofa("Metal", "Grey", "200x85x90 cm");
        
        $this->prototypes['VictorianCoffeeTable'] = new CoffeeTable("Wood", "Mahogany", "90x50x40 cm");
        $this->prototypes['ModernCoffeeTable'] = new CoffeeTable("Glass", "Transparent", "100x50x45 cm");
    }

    public function getPrototype(string $prototypeName): FurniturePrototype {
        return clone $this->prototypes[$prototypeName];
    }
}

function clientCode() {
    $prototypeManager = new FurniturePrototypeManager();

    // Clone a Victorian Chair
    $victorianChair = $prototypeManager->getPrototype('VictorianChair');
    $victorianChair->showDetails();

    // Clone a Modern Sofa
    $modernSofa = $prototypeManager->getPrototype('ModernSofa');
    $modernSofa->showDetails();

    // Clone and customize a Victorian Coffee Table
    $customCoffeeTable = $prototypeManager->getPrototype('VictorianCoffeeTable');
    $customCoffeeTable->color = "Cherry Red"; // Customize the clone
    $customCoffeeTable->showDetails();
}

clientCode();