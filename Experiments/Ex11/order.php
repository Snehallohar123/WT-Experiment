<?php
include 'db.php';

if (isset($_POST['customer_name']) && isset($_POST['table_number']) && isset($_POST['items'])) {
    $customer_name = $_POST['customer_name'];
    $table_number = $_POST['table_number'];
    $items = $_POST['items'];

    // Insert into orders
    $conn->query("INSERT INTO orders (customer_name, table_number, total) VALUES ('$customer_name', '$table_number', 0)");
    $order_id = $conn->insert_id;

    $total = 0;
    foreach ($items as $item_id) {
        $menu_item = $conn->query("SELECT * FROM menu WHERE id=$item_id")->fetch_assoc();
        $price = $menu_item['price'];
        $total += $price;

        $conn->query("INSERT INTO order_items (order_id, menu_item_id, quantity) VALUES ($order_id, $item_id, 1)");
    }

    // Update total
    $conn->query("UPDATE orders SET total=$total WHERE id=$order_id");

    header("Location: bill.php?order_id=$order_id");
} else {
    echo "Invalid Request.";
}
?>
