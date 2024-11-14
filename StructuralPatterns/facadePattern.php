<?php

class Chair {
    public function create(): void {
        echo "Chair created.\n";
    }

    public function setup(): void {
        echo "Chair setup completed.\n";
    }
}

class Sofa {
    public function create(): void {
        echo "Sofa created.\n";
    }

    public function setup(): void {
        echo "Sofa setup completed.\n";
    }
}

class CoffeeTable {
    public function create(): void {
        echo "Coffee Table created.\n";
    }

    public function setup(): void {
        echo "Coffee Table setup completed.\n";
    }
}

class FurnitureFacade {
    private Chair $chair;
    private Sofa $sofa;
    private CoffeeTable $coffeeTable;

    public function __construct() {
        $this->chair = new Chair();
        $this->sofa = new Sofa();
        $this->coffeeTable = new CoffeeTable();
    }

    public function createLivingRoomSet(): void {
        echo "Creating Living Room Set:\n";
        $this->chair->create();
        $this->sofa->create();
        $this->coffeeTable->create();
        echo "Living Room Set created successfully.\n";
    }

    public function setupLivingRoomSet(): void {
        echo "Setting up Living Room Set:\n";
        $this->chair->setup();
        $this->sofa->setup();
        $this->coffeeTable->setup();
        echo "Living Room Set setup completed.\n";
    }

    public function createAndSetupFullSet(): void {
        $this->createLivingRoomSet();
        $this->setupLivingRoomSet();
    }
}

function clientCode() {
    $furnitureFacade = new FurnitureFacade();

    // Use the facade to create and set up a living room furniture set
    $furnitureFacade->createAndSetupFullSet();
}

clientCode();