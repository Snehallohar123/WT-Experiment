<?php
include 'db.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $order = $conn->query("SELECT * FROM orders WHERE id=$order_id")->fetch_assoc();
    $items = $conn->query("SELECT menu.item_name, menu.price FROM order_items JOIN menu ON order_items.menu_item_id = menu.id WHERE order_items.order_id=$order_id");
} else {
    echo "Order not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bill</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Bill for Order #<?php echo $order_id; ?></h2>
    <p><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
    <p><strong>Table Number:</strong> <?php echo $order['table_number']; ?></p>
    <p><strong>Order Time:</strong> <?php echo $order['order_time']; ?></p>

    <h3>Ordered Items:</h3>
    <ul>
    <?php

    while($row = $items->fetch_assoc()) {
        echo "<li>".$row['item_name']." - $".$row['price']."</li>";
    }
    ?>
    </ul>

    <h3>Total Amount: $<?php echo $order['total']; ?></h3>
    <br><br>
    <a href="index.php">Place New Order</a>
</body>
</html>
