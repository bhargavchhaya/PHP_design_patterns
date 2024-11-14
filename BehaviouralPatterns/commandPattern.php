<?php

interface Command {
    public function execute(): void;
}

class FurnitureItem {
    private string $type;

    public function __construct(string $type) {
        $this->type = $type;
    }

    public function addToCart(): void {
        echo "Adding {$this->type} to cart.\n";
    }

    public function removeFromCart(): void {
        echo "Removing {$this->type} from cart.\n";
    }

    public function placeOrder(): void {
        echo "Placing order for {$this->type}.\n";
    }
}

class AddToCartCommand implements Command {
    private FurnitureItem $item;

    public function __construct(FurnitureItem $item) {
        $this->item = $item;
    }

    public function execute(): void {
        $this->item->addToCart();
    }
}

class RemoveFromCartCommand implements Command {
    private FurnitureItem $item;

    public function __construct(FurnitureItem $item) {
        $this->item = $item;
    }

    public function execute(): void {
        $this->item->removeFromCart();
    }
}

class PlaceOrderCommand implements Command {
    private FurnitureItem $item;

    public function __construct(FurnitureItem $item) {
        $this->item = $item;
    }

    public function execute(): void {
        $this->item->placeOrder();
    }
}

class Cart {
    private array $commands = [];

    public function addCommand(Command $command): void {
        $this->commands[] = $command;
    }

    public function executeCommands(): void {
        foreach ($this->commands as $command) {
            $command->execute();
        }
        // Clear commands after executing them
        $this->commands = [];
    }
}

function clientCode() {
    // Create furniture items
    $chair = new FurnitureItem("Chair");
    $sofa = new FurnitureItem("Sofa");
    $coffeeTable = new FurnitureItem("Coffee Table");

    // Create commands for each item
    $addChairCommand = new AddToCartCommand($chair);
    $removeSofaCommand = new RemoveFromCartCommand($sofa);
    $placeOrderCommand = new PlaceOrderCommand($coffeeTable);

    // Create cart and add commands
    $cart = new Cart();
    $cart->addCommand($addChairCommand);
    $cart->addCommand($removeSofaCommand);
    $cart->addCommand($placeOrderCommand);

    // Execute all commands
    echo "Executing cart commands:\n";
    $cart->executeCommands();
}

clientCode();