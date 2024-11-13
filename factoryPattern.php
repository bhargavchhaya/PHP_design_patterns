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

class FurnitureFactory {
    public static function createFurniture(string $furnitureType, string $style) {
        switch ($furnitureType) {
            case 'Chair':
                return self::createChair($style);
            case 'Sofa':
                return self::createSofa($style);
            case 'CoffeeTable':
                return self::createCoffeeTable($style);
            default:
                throw new Exception("Invalid furniture type");
        }
    }

    private static function createChair(string $style): Chair {
        switch ($style) {
            case 'Victorian':
                return new VictorianChair();
            case 'Modern':
                return new ModernChair();
            default:
                throw new Exception("Invalid style for Chair");
        }
    }

    private static function createSofa(string $style): Sofa {
        switch ($style) {
            case 'Victorian':
                return new VictorianSofa();
            case 'Modern':
                return new ModernSofa();
            default:
                throw new Exception("Invalid style for Sofa");
        }
    }

    private static function createCoffeeTable(string $style): CoffeeTable {
        switch ($style) {
            case 'Victorian':
                return new VictorianCoffeeTable();
            case 'Modern':
                return new ModernCoffeeTable();
            default:
                throw new Exception("Invalid style for Coffee Table");
        }
    }
}

function clientCode() {
    // Create Victorian Chair
    $victorianChair = FurnitureFactory::createFurniture('Chair', 'Victorian');
    echo $victorianChair->sitOn() . PHP_EOL;

    // Create Modern Sofa
    $modernSofa = FurnitureFactory::createFurniture('Sofa', 'Modern');
    echo $modernSofa->lieOn() . PHP_EOL;

    // Create Victorian Coffee Table
    $victorianCoffeeTable = FurnitureFactory::createFurniture('CoffeeTable', 'Victorian');
    echo $victorianCoffeeTable->placeItemsOn() . PHP_EOL;
}

clientCode();

?>
