<?php

interface Observer {
    public function update(float $newPrice): void;
}

class FurnitureItem {
    private $name;
    private $price;
    private $observers = [];

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    // Attach an observer
    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    // Detach an observer
    public function detach(Observer $observer): void {
        $this->observers = array_filter($this->observers, function($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    // Notify all observers
    public function notify(): void {
        foreach ($this->observers as $observer) {
            $observer->update($this->price);
        }
    }

    // Change the price and notify observers
    public function setPrice(float $price): void {
        $this->price = $price;
        $this->notify();
    }

    // Get the price
    public function getPrice(): float {
        return $this->price;
    }

    public function getName(): string {
        return $this->name;
    }
}

class Chair implements Observer {
    private $name;
    private $price;

    public function __construct($name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function update(float $newPrice): void {
        echo $this->name . " is observing a price update. New price: $" . $newPrice . "\n";
        $this->price = $newPrice;  // Chair updates its price when notified
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getName(): string {
        return $this->name;
    }
}

class Sofa implements Observer {
    private $name;
    private $price;

    public function __construct($name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function update(float $newPrice): void {
        echo $this->name . " is observing a price update. New price: $" . $newPrice . "\n";
        $this->price = $newPrice;  // Sofa updates its price when notified
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getName(): string {
        return $this->name;
    }
}

class CoffeeTable implements Observer {
    private $name;
    private $price;

    public function __construct($name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function update(float $newPrice): void {
        echo $this->name . " is observing a price update. New price: $" . $newPrice . "\n";
        $this->price = $newPrice;  // CoffeeTable updates its price when notified
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getName(): string {
        return $this->name;
    }
}

function clientCode() {
    // Create instances of specific furniture items
    $chair = new Chair("Chair", 150.00);
    $sofa = new Sofa("Sofa", 550.00);
    $coffeeTable = new CoffeeTable("Coffee Table", 120.00);

    // Create the furniture item as the subject
    $furniture = new FurnitureItem("Furniture Set", 500.00);

    // Attach observers (furniture items)
    $furniture->attach($chair);
    $furniture->attach($sofa);
    $furniture->attach($coffeeTable);

    // Change the price of the furniture (this will notify the observers)
    echo "Initial Price of Furniture: $" . $furniture->getPrice() . "\n";
    $furniture->setPrice(550.00);  // This will notify all observers about the price change
    $furniture->setPrice(600.00);  // Another price update
}

clientCode();