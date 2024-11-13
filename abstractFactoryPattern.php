<?php

interface Chair {
    public function sitOn(): string;
}

interface Sofa {
    public function lieOn(): string;
}

interface CoffeeTable {
    public function placeItemsOn(): string;
}

class VictorianChair implements Chair {
    public function sitOn(): string {
        return "Sitting on a Victorian chair";
    }
}

class VictorianSofa implements Sofa {
    public function lieOn(): string {
        return "Lying on a Victorian sofa";
    }
}

class VictorianCoffeeTable implements CoffeeTable {
    public function placeItemsOn(): string {
        return "Placing items on a Victorian coffee table";
    }
}

class ModernChair implements Chair {
    public function sitOn(): string {
        return "Sitting on a Modern chair";
    }
}

class ModernSofa implements Sofa {
    public function lieOn(): string {
        return "Lying on a Modern sofa";
    }
}

class ModernCoffeeTable implements CoffeeTable {
    public function placeItemsOn(): string {
        return "Placing items on a Modern coffee table";
    }
}

interface FurnitureFactory {
    public function createChair(): Chair;
    public function createSofa(): Sofa;
    public function createCoffeeTable(): CoffeeTable;
}

class VictorianFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair {
        return new VictorianChair();
    }

    public function createSofa(): Sofa {
        return new VictorianSofa();
    }

    public function createCoffeeTable(): CoffeeTable {
        return new VictorianCoffeeTable();
    }
}

class ModernFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair {
        return new ModernChair();
    }

    public function createSofa(): Sofa {
        return new ModernSofa();
    }

    public function createCoffeeTable(): CoffeeTable {
        return new ModernCoffeeTable();
    }
}


function clientCode(FurnitureFactory $factory) {
    $chair = $factory->createChair();
    $sofa = $factory->createSofa();
    $coffeeTable = $factory->createCoffeeTable();

    echo $chair->sitOn() . PHP_EOL;
    echo $sofa->lieOn() . PHP_EOL;
    echo $coffeeTable->placeItemsOn() . PHP_EOL;
}

// Usage:

echo "Victorian Furniture:" . PHP_EOL;
$victorianFactory = new VictorianFurnitureFactory();
clientCode($victorianFactory);

echo PHP_EOL;

echo "Modern Furniture:" . PHP_EOL;
$modernFactory = new ModernFurnitureFactory();
clientCode($modernFactory);

?>
