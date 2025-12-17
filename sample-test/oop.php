<?php

class User 
{
    private string $name;
    private string $email;

    public function __construct(string $name, string $email) {
        $this->setName($name);
        $this->setEmail($email);
    }

    public function getName() : string { 
        return $this->name;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setName(string $name) : void {
        if (empty($name) || strlen($name) < 5) {
            throw new InvalidArgumentException("Name cannot be empty and must be greater than 4 characters");
        }
        $this->name = htmlspecialchars(trim(strip_tags($name)), ENT_QUOTES, 'UTF-8');
    }

    public function setEmail(string $email) : void {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8');
        } else {
            throw new InvalidArgumentException("Invalid email format");
        }
    }
}

// Example usage
try {
    $user = new User("John Doe", "john.doe@example.com");
    echo "Name: " . $user->getName() . "\n";
    echo "Email: " . $user->getEmail() . "\n";  
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}


abstract class PaymentProcessor {
    protected PaymentGateway $gateway;

    public function __construct(PaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    abstract public function process(float $amount): bool;
}

interface PaymentGateway {
    public function processPayment(float $amount): bool;
}

class StripePaymentGateway implements PaymentGateway {
    public function processPayment(float $amount): bool {
        // Simulate payment processing logic
        echo "Processing payment of $$amount through Stripe.\n";
        return true; // Assume payment is successful
    }
}

class PaystackGateway implements PaymentGateway {
    public function processPayment(float $amount): bool {
        // Simulate payment processing logic
        echo "Processing payment of $$amount through Paystack.\n";
        return true; // Assume payment is successful
    }
}

class StripePaymentProcessor extends PaymentProcessor {
    public function process(float $amount): bool {
        return $this->gateway->processPayment($amount);
    }
}

class PaystackPaymentProcessor extends PaymentProcessor {
    public function process(float $amount): bool {
        return $this->gateway->processPayment($amount);
    }
}

/**
 * Singleton Responsibility Principle Example
 */

class Order {
    public function __construct(private float $amount) {}
    public function getAmount(): float {
        return $this->amount;
    }
    public function setAmount(float $amount): void {
        if ($amount < 0) {
            throw new InvalidArgumentException("Amount cannot be negative");
        }
        $this->amount = $amount;
    }
    public function getOrderDetails(): string {
        return "Order amount: $" . $this->amount;
    }
    public function processOrder(): void {
        // Logic to process the order
        echo "Processing order of amount: $" . $this->amount . "\n";
    }
    public function saveOrder(): void {
        // Logic to save order to database
        echo "Order of amount $" . $this->amount . " saved to database.\n";
    }
    public function sendOrderConfirmationEmail(string $email): void {
        // Logic to send confirmation email
        echo "Order confirmation email sent to " . $email . "\n";
    }
    public function generateInvoice(): void {
        // Logic to generate invoice
        echo "Invoice generated for order amount: $" . $this->amount . "\n";
    }
    public function applyDiscount(float $percentage): void {
        $discount = $this->amount * ($percentage / 100);
        $this->amount -= $discount;
        echo "Applied discount of $" . $discount . ". New amount: $" . $this->amount . "\n";
    }
    public function calculateTax(float $taxRate): float {
        $tax = $this->amount * ($taxRate / 100);
        echo "Calculated tax of $" . $tax . " on amount: $" . $this->amount . "\n";
        return $tax;
    }
    public function trackShipment(string $trackingNumber): void {
        // Logic to track shipment
        echo "Tracking shipment with tracking number: " . $trackingNumber . "\n";
    }
    public function returnOrder(): void {
        // Logic to handle order return
        echo "Order of amount $" . $this->amount . " has been returned.\n";
    }
    public function cancelOrder(): void {
        // Logic to cancel order
        echo "Order of amount $" . $this->amount . " has been canceled.\n";
    }
    public function rateOrder(int $rating): void {
        // Logic to rate order
        echo "Order of amount $" . $this->amount . " rated with " . $rating . " stars.\n";
    }
    public function leaveFeedback(string $feedback): void {
        // Logic to leave feedback
        echo "Feedback for order of amount $" . $this->amount . ": " . $feedback . "\n";
    }
    public function reorder(): void {
        // Logic to reorder
        echo "Reordering the order of amount $" . $this->amount . "\n";
    }
    public function trackOrderStatus(): void {
        // Logic to track order status
        echo "Tracking status for order of amount $" . $this->amount . "\n";
    }
    public function estimateDeliveryDate(): void {
        // Logic to estimate delivery date
        echo "Estimated delivery date for order of amount $" . $this->amount . " is in 5 days.\n";
    }
    public function giftWrapOrder(): void {
        // Logic to gift wrap order
        echo "Order of amount $" . $this->amount . " has been gift wrapped.\n";
    }
}

// Example usage
$order = new Order(100.00);
$order->processOrder();
$order->saveOrder();
$order->sendOrderConfirmationEmail("customer@example.com");
$order->generateInvoice();
$order->applyDiscount(10);  
$order->calculateTax(5);
$order->trackShipment("TRACK12345");
$order->returnOrder();
$order->cancelOrder();
$order->rateOrder(5);
$order->leaveFeedback("Great service!");
$order->reorder();
$order->trackOrderStatus();
$order->estimateDeliveryDate();
$order->giftWrapOrder();
