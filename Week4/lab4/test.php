<?php
require_once __DIR__ . '/service/MenuItemService.php';
require_once __DIR__ . '/service/OrderService.php';

$menu_item_service = new MenuItemService();
$order_service = new OrderService();

echo "<h3>✅ Testiranje MenuItemService:</h3>";

// Dodaj novi item
try {
    $menu_item = $menu_item_service->createMenuItem([
        'name' => 'Pizza Margherita',
        'category' => 'Pizza',
        'price' => 12.5
    ]);
    print_r($menu_item);
} catch (Exception $e) {
    echo "Greška: " . $e->getMessage();
}

// Dohvati po kategoriji
$items = $menu_item_service->getByCategory('Pizza');
print_r($items);

echo "<h3>✅ Testiranje OrderService:</h3>";

// Dohvati porudžbine korisnika
$orders = $order_service->getByUserId(1);
print_r($orders);
