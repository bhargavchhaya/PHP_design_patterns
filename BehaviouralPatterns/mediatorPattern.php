<?php

abstract class FurnitureItem {
    protected $mediator;

    public function __construct($mediator) {
        $this->mediator = $mediator;
    }

    abstract public function getName(): string;
    abstract public function getPrice(): float;
    abstract public function interact(): void;
}

class Chair extends FurnitureItem {
    private $price = 150.00;

    public function getName(): string {
        return "Chair";
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function interact(): void {
        echo "Chair is interacting with the mediator...\n";
        $this->mediator->coordinate($this);
    }
}

class Sofa extends FurnitureItem {
    private $price = 550.00;

    public function getName(): string {
        return "Sofa";
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function interact(): void {
        echo "Sofa is interacting with the mediator...\n";
        $this->mediator->coordinate($this);
    }
}

class CoffeeTable extends FurnitureItem {
    private $price = 120.00;

    public function getName(): string {
        return "Coffee Table";
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function interact(): void {
        echo "Coffee Table is interacting with the mediator...\n";
        $this->mediator->coordinate($this);
    }
}

class FurnitureMediator {
    private $chair;
    private $sofa;
    private $coffeeTable;

    public function __construct(Chair $chair, Sofa $sofa, CoffeeTable $coffeeTable) {
        $this->chair = $chair;
        $this->sofa = $sofa;
        $this->coffeeTable = $coffeeTable;
    }

    // Coordinates actions between furniture items
    public function coordinate(FurnitureItem $item): void {
        echo "Mediator is coordinating interaction for: " . $item->getName() . "\n";
        // Example logic: When any item interacts, it communicates with others
        if ($item instanceof Chair) {
            echo $this->sofa->getName() . " and " . $this->coffeeTable->getName() . " are available as related items.\n";
        } elseif ($item instanceof Sofa) {
            echo $this->chair->getName() . " and " . $this->coffeeTable->getName() . " are available as related items.\n";
        } elseif ($item instanceof CoffeeTable) {
            echo $this->chair->getName() . " and " . $this->sofa->getName() . " are available as related items.\n";
        }
    }
}

function clientCode() {
    // Create instances of specific furniture items
    $mediator = new FurnitureMediator(
        new Chair(null), 
        new Sofa(null), 
        new CoffeeTable(null)
    );
    
    // Set the mediator for each furniture item
    $chair = new Chair($mediator);
    $sofa = new Sofa($mediator);
    $coffeeTable = new CoffeeTable($mediator);

    // Interact with the mediator through the furniture items
    $chair->interact();
    $sofa->interact();
    $coffeeTable->interact();
}

clientCode();