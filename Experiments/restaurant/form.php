<?php
$conn = mysqli_connect("localhost", "root", "");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select database
mysqli_select_db($conn, "restaurant");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer = $_POST["customer"];
    $item = $_POST["item"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $total = $quantity * $price;

    $sql = "INSERT INTO orders (customer_name, item_name, quantity, price_per_item, total_price) 
    VALUES ('$customer', '$item', '$quantity', '$price', '$total')";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Order Booked Successfully!</h2>";
        echo "Customer Name: $customer<br>";
        echo "Item: $item<br>";
        echo "Quantity: $quantity<br>";
        echo "Price per Item: $price<br>";
        echo "Total Bill: $total<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
