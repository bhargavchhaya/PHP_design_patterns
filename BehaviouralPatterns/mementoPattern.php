<?php

class FurnitureItem {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    // Save the current state to a Memento
    public function saveStateToMemento(): Memento {
        return new Memento($this->price);
    }

    // Restore the state from a Memento
    public function restoreStateFromMemento(Memento $memento): void {
        $this->price = $memento->getState();
    }
}

class Memento {
    private $price;

    public function __construct(float $price) {
        $this->price = $price;
    }

    public function getState(): float {
        return $this->price;
    }
}

class Caretaker {
    private $mementos = [];

    // Save the state (Memento)
    public function addMemento(Memento $memento): void {
        $this->mementos[] = $memento;
    }

    // Get the last saved state (Memento)
    public function getMemento(): Memento {
        return array_pop($this->mementos);
    }
}

class Chair extends FurnitureItem {
    public function __construct(float $price) {
        parent::__construct("Chair", $price);
    }
}

class Sofa extends FurnitureItem {
    public function __construct(float $price) {
        parent::__construct("Sofa", $price);
    }
}

class CoffeeTable extends FurnitureItem {
    public function __construct(float $price) {
        parent::__construct("Coffee Table", $price);
    }
}

function clientCode() {
    // Create Caretaker to hold mementos
    $caretaker = new Caretaker();

    // Create some furniture items with initial prices
    $chair = new Chair(150.00);
    $sofa = new Sofa(550.00);
    $coffeeTable = new CoffeeTable(120.00);

    echo "Original Prices:\n";
    echo $chair->getName() . " Price: $" . $chair->getPrice() . "\n";
    echo $sofa->getName() . " Price: $" . $sofa->getPrice() . "\n";
    echo $coffeeTable->getName() . " Price: $" . $coffeeTable->getPrice() . "\n";

    // Save the current state (prices)
    $caretaker->addMemento($chair->saveStateToMemento());
    $caretaker->addMemento($sofa->saveStateToMemento());
    $caretaker->addMemento($coffeeTable->saveStateToMemento());

    // Modify the prices of the furniture items
    $chair->setPrice(170.00);
    $sofa->setPrice(600.00);
    $coffeeTable->setPrice(140.00);

    echo "\nModified Prices:\n";
    echo $chair->getName() . " Price: $" . $chair->getPrice() . "\n";
    echo $sofa->getName() . " Price: $" . $sofa->getPrice() . "\n";
    echo $coffeeTable->getName() . " Price: $" . $coffeeTable->getPrice() . "\n";

    // Restore the state of the furniture items (undo changes)
    $chair->restoreStateFromMemento($caretaker->getMemento());
    $sofa->restoreStateFromMemento($caretaker->getMemento());
    $coffeeTable->restoreStateFromMemento($caretaker->getMemento());

    echo "\nRestored Prices:\n";
    echo $chair->getName() . " Price: $" . $chair->getPrice() . "\n";
    echo $sofa->getName() . " Price: $" . $sofa->getPrice() . "\n";
    echo $coffeeTable->getName() . " Price: $" . $coffeeTable->getPrice() . "\n";
}

clientCode();