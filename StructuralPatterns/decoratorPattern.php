<?php

interface Furniture {
    public function getDescription(): string;
    public function getCost(): float;
}

class Chair implements Furniture {
    public function getDescription(): string {
        return "Chair";
    }

    public function getCost(): float {
        return 100.0; // Base cost of a chair
    }
}

class Sofa implements Furniture {
    public function getDescription(): string {
        return "Sofa";
    }

    public function getCost(): float {
        return 300.0; // Base cost of a sofa
    }
}

class CoffeeTable implements Furniture {
    public function getDescription(): string {
        return "Coffee Table";
    }

    public function getCost(): float {
        return 150.0; // Base cost of a coffee table
    }
}

abstract class FurnitureDecorator implements Furniture {
    protected Furniture $furniture;

    public function __construct(Furniture $furniture) {
        $this->furniture = $furniture;
    }

    public function getDescription(): string {
        return $this->furniture->getDescription();
    }

    public function getCost(): float {
        return $this->furniture->getCost();
    }
}

class CushionDecorator extends FurnitureDecorator {
    public function getDescription(): string {
        return $this->furniture->getDescription() . " with Cushion";
    }

    public function getCost(): float {
        return $this->furniture->getCost() + 20.0; // Cushion cost
    }
}

class ArmrestDecorator extends FurnitureDecorator {
    public function getDescription(): string {
        return $this->furniture->getDescription() . " with Armrest";
    }

    public function getCost(): float {
        return $this->furniture->getCost() + 30.0; // Armrest cost
    }
}

class CoverDecorator extends FurnitureDecorator {
    public function getDescription(): string {
        return $this->furniture->getDescription() . " with Cover";
    }

    public function getCost(): float {
        return $this->furniture->getCost() + 15.0; // Cover cost
    }
}

function clientCode() {
    // Create a basic chair
    $chair = new Chair();
    echo $chair->getDescription() . " costs $" . $chair->getCost() . "\n";

    // Add a cushion to the chair
    $chairWithCushion = new CushionDecorator($chair);
    echo $chairWithCushion->getDescription() . " costs $" . $chairWithCushion->getCost() . "\n";

    // Add an armrest to the chair with a cushion
    $chairWithCushionAndArmrest = new ArmrestDecorator($chairWithCushion);
    echo $chairWithCushionAndArmrest->getDescription() . " costs $" . $chairWithCushionAndArmrest->getCost() . "\n";

    // Create a sofa with a cover and cushion
    $sofa = new Sofa();
    $sofaWithCover = new CoverDecorator($sofa);
    $sofaWithCoverAndCushion = new CushionDecorator($sofaWithCover);
    echo $sofaWithCoverAndCushion->getDescription() . " costs $" . $sofaWithCoverAndCushion->getCost() . "\n";
}

clientCode();