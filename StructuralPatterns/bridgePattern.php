<?php

interface FurnitureStyle {
    public function getStyle(): string;
}

class ModernStyle implements FurnitureStyle {
    public function getStyle(): string {
        return "Modern";
    }
}

class VictorianStyle implements FurnitureStyle {
    public function getStyle(): string {
        return "Victorian";
    }
}

abstract class Furniture {
    protected FurnitureStyle $style;

    public function __construct(FurnitureStyle $style) {
        $this->style = $style;
    }

    abstract public function getDescription(): string;
}

class Chair extends Furniture {
    public function getDescription(): string {
        return "Chair in " . $this->style->getStyle() . " style";
    }
}

class Sofa extends Furniture {
    public function getDescription(): string {
        return "Sofa in " . $this->style->getStyle() . " style";
    }
}

class CoffeeTable extends Furniture {
    public function getDescription(): string {
        return "Coffee Table in " . $this->style->getStyle() . " style";
    }
}

function clientCode() {
    // Create furniture with Modern style
    $modernStyle = new ModernStyle();
    $modernChair = new Chair($modernStyle);
    $modernSofa = new Sofa($modernStyle);
    $modernCoffeeTable = new CoffeeTable($modernStyle);

    echo $modernChair->getDescription() . "\n";
    echo $modernSofa->getDescription() . "\n";
    echo $modernCoffeeTable->getDescription() . "\n";

    // Create furniture with Victorian style
    $victorianStyle = new VictorianStyle();
    $victorianChair = new Chair($victorianStyle);
    $victorianSofa = new Sofa($victorianStyle);
    $victorianCoffeeTable = new CoffeeTable($victorianStyle);

    echo $victorianChair->getDescription() . "\n";
    echo $victorianSofa->getDescription() . "\n";
    echo $victorianCoffeeTable->getDescription() . "\n";
}

clientCode();