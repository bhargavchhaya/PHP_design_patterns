<?php

class FurnitureSet {
    public $chair;
    public $sofa;
    public $coffeeTable;
    public $material;
    public $color;
    public $style;

    public function show(): void {
        echo "Furniture Set [Style: {$this->style}, Material: {$this->material}, Color: {$this->color}]\n";
        echo "- Chair: {$this->chair}\n";
        echo "- Sofa: {$this->sofa}\n";
        echo "- Coffee Table: {$this->coffeeTable}\n";
    }
}

interface FurnitureBuilder {
    public function setMaterial(string $material): FurnitureBuilder;
    public function setColor(string $color): FurnitureBuilder;
    public function setStyle(string $style): FurnitureBuilder;
    public function addChair(string $chair): FurnitureBuilder;
    public function addSofa(string $sofa): FurnitureBuilder;
    public function addCoffeeTable(string $coffeeTable): FurnitureBuilder;
    public function getFurnitureSet(): FurnitureSet;
}

class ConcreteFurnitureBuilder implements FurnitureBuilder {
    private FurnitureSet $furnitureSet;

    public function __construct() {
        $this->reset();
    }

    public function reset(): void {
        $this->furnitureSet = new FurnitureSet();
    }

    public function setMaterial(string $material): FurnitureBuilder {
        $this->furnitureSet->material = $material;
        return $this;
    }

    public function setColor(string $color): FurnitureBuilder {
        $this->furnitureSet->color = $color;
        return $this;
    }

    public function setStyle(string $style): FurnitureBuilder {
        $this->furnitureSet->style = $style;
        return $this;
    }

    public function addChair(string $chair): FurnitureBuilder {
        $this->furnitureSet->chair = $chair;
        return $this;
    }

    public function addSofa(string $sofa): FurnitureBuilder {
        $this->furnitureSet->sofa = $sofa;
        return $this;
    }

    public function addCoffeeTable(string $coffeeTable): FurnitureBuilder {
        $this->furnitureSet->coffeeTable = $coffeeTable;
        return $this;
    }

    public function getFurnitureSet(): FurnitureSet {
        $result = $this->furnitureSet;
        $this->reset();  // Reset for a new build
        return $result;
    }
}

class Director {
    private FurnitureBuilder $builder;

    public function setBuilder(FurnitureBuilder $builder): void {
        $this->builder = $builder;
    }

    public function buildVictorianSet(): FurnitureSet {
        return $this->builder
            ->setMaterial('Wood')
            ->setColor('Mahogany')
            ->setStyle('Victorian')
            ->addChair('Victorian Chair')
            ->addSofa('Victorian Sofa')
            ->addCoffeeTable('Victorian Coffee Table')
            ->getFurnitureSet();
    }

    public function buildModernSet(): FurnitureSet {
        return $this->builder
            ->setMaterial('Metal')
            ->setColor('Black')
            ->setStyle('Modern')
            ->addChair('Modern Chair')
            ->addSofa('Modern Sofa')
            ->addCoffeeTable('Modern Coffee Table')
            ->getFurnitureSet();
    }
}

function clientCode() {
    $director = new Director();
    $builder = new ConcreteFurnitureBuilder();
    
    // Using the director to build a Victorian set
    $director->setBuilder($builder);
    $victorianSet = $director->buildVictorianSet();
    $victorianSet->show();

    echo PHP_EOL;

    // Using the director to build a Modern set
    $modernSet = $director->buildModernSet();
    $modernSet->show();

    echo PHP_EOL;

    // Custom furniture set without the director
    $customSet = $builder
        ->setMaterial('Plastic')
        ->setColor('White')
        ->setStyle('Custom')
        ->addChair('Custom Chair')
        ->addSofa('Custom Sofa')
        ->addCoffeeTable('Custom Coffee Table')
        ->getFurnitureSet();
    $customSet->show();
}

clientCode();