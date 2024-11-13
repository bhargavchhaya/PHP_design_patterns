<?php

interface FurnitureInterface {
    public function getName(): string;
    public function getMaterial(): string;
    public function getDimensions(): string;
}

class LegacyChair {
    private string $type;
    private string $material;
    private string $size;

    public function __construct(string $type, string $material, string $size) {
        $this->type = $type;
        $this->material = $material;
        $this->size = $size;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMaterialType(): string {
        return $this->material;
    }

    public function getSize(): string {
        return $this->size;
    }
}

class LegacySofa {
    private string $model;
    private string $material;
    private string $dimensions;

    public function __construct(string $model, string $material, string $dimensions) {
        $this->model = $model;
        $this->material = $material;
        $this->dimensions = $dimensions;
    }

    public function getModelName(): string {
        return $this->model;
    }

    public function getMaterialUsed(): string {
        return $this->material;
    }

    public function getSofaDimensions(): string {
        return $this->dimensions;
    }
}

class LegacyCoffeeTable {
    private string $name;
    private string $woodType;
    private string $dimensions;

    public function __construct(string $name, string $woodType, string $dimensions) {
        $this->name = $name;
        $this->woodType = $woodType;
        $this->dimensions = $dimensions;
    }

    public function getTableName(): string {
        return $this->name;
    }

    public function getWoodType(): string {
        return $this->woodType;
    }

    public function getTableDimensions(): string {
        return $this->dimensions;
    }
}

class ChairAdapter implements FurnitureInterface {
    private LegacyChair $legacyChair;

    public function __construct(LegacyChair $legacyChair) {
        $this->legacyChair = $legacyChair;
    }

    public function getName(): string {
        return $this->legacyChair->getType();
    }

    public function getMaterial(): string {
        return $this->legacyChair->getMaterialType();
    }

    public function getDimensions(): string {
        return $this->legacyChair->getSize();
    }
}

class SofaAdapter implements FurnitureInterface {
    private LegacySofa $legacySofa;

    public function __construct(LegacySofa $legacySofa) {
        $this->legacySofa = $legacySofa;
    }

    public function getName(): string {
        return $this->legacySofa->getModelName();
    }

    public function getMaterial(): string {
        return $this->legacySofa->getMaterialUsed();
    }

    public function getDimensions(): string {
        return $this->legacySofa->getSofaDimensions();
    }
}

class CoffeeTableAdapter implements FurnitureInterface {
    private LegacyCoffeeTable $legacyCoffeeTable;

    public function __construct(LegacyCoffeeTable $legacyCoffeeTable) {
        $this->legacyCoffeeTable = $legacyCoffeeTable;
    }

    public function getName(): string {
        return $this->legacyCoffeeTable->getTableName();
    }

    public function getMaterial(): string {
        return $this->legacyCoffeeTable->getWoodType();
    }

    public function getDimensions(): string {
        return $this->legacyCoffeeTable->getTableDimensions();
    }
}

function clientCode(FurnitureInterface $furniture) {
    echo "Furniture Details:\n";
    echo "- Name: " . $furniture->getName() . "\n";
    echo "- Material: " . $furniture->getMaterial() . "\n";
    echo "- Dimensions: " . $furniture->getDimensions() . "\n";
    echo "\n";
}

// Example usage with the adapters
$legacyChair = new LegacyChair("Classic Chair", "Wood", "40x40x90 cm");
$chairAdapter = new ChairAdapter($legacyChair);
clientCode($chairAdapter);

$legacySofa = new LegacySofa("Modern Sofa", "Leather", "200x90x100 cm");
$sofaAdapter = new SofaAdapter($legacySofa);
clientCode($sofaAdapter);

$legacyCoffeeTable = new LegacyCoffeeTable("Coffee Table", "Oak", "100x50x45 cm");
$coffeeTableAdapter = new CoffeeTableAdapter($legacyCoffeeTable);
clientCode($coffeeTableAdapter);