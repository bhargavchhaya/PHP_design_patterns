<?php

interface OrderHandler {
    public function setNext(OrderHandler $handler): OrderHandler;
    public function handle(array $order): ?string;
}

abstract class AbstractOrderHandler implements OrderHandler {
    private ?OrderHandler $nextHandler = null;

    public function setNext(OrderHandler $handler): OrderHandler {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(array $order): ?string {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($order);
        }
        return null;
    }
}

class ValidationHandler extends AbstractOrderHandler {
    public function handle(array $order): ?string {
        if (empty($order['item']) || empty($order['quantity'])) {
            return "Validation failed: Missing item or quantity.";
        }
        echo "Validation passed for item: {$order['item']}.\n";
        return parent::handle($order);
    }
}

class DiscountHandler extends AbstractOrderHandler {
    private int $discountThreshold = 5;
    private float $discountRate = 0.1;

    public function handle(array $order): ?string {
        if ($order['quantity'] > $this->discountThreshold) {
            $discount = $order['quantity'] * $order['price'] * $this->discountRate;
            echo "Discount of {$discount} applied for quantity of {$order['quantity']}.\n";
        } else {
            echo "No discount applied.\n";
        }
        return parent::handle($order);
    }
}

class ShippingHandler extends AbstractOrderHandler {
    public function handle(array $order): ?string {
        echo "Shipping order for item: {$order['item']}, Quantity: {$order['quantity']} to address: {$order['address']}.\n";
        return "Order processed successfully!";
    }
}

function clientCode() {
    // Set up the chain of responsibility
    $validationHandler = new ValidationHandler();
    $discountHandler = new DiscountHandler();
    $shippingHandler = new ShippingHandler();

    $validationHandler->setNext($discountHandler)->setNext($shippingHandler);

    // Define an order for a chair
    $order = [
        'item' => 'Chair',
        'quantity' => 6,
        'price' => 100,
        'address' => '123 Furniture Lane'
    ];

    // Process the order through the chain
    $result = $validationHandler->handle($order);

    // Output the final result
    if ($result) {
        echo $result;
    } else {
        echo "Order could not be processed.";
    }
}

clientCode();