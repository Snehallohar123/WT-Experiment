<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Restaurant Menu</h2>
    <form action="order.php" method="POST">
        Customer Name: <input type="text" name="customer_name" required><br><br>
        Table Number: <input type="number" name="table_number" required><br><br>

        <h3>Choose Items:</h3>
        <?php
        $result = $conn->query("SELECT * FROM menu");
        while($row = $result->fetch_assoc()) {
            echo '<input type="checkbox" name="items[]" value="'.$row['id'].'"> '.$row['item_name'].' ($'.$row['price'].') <br>';
        }
        ?>
        <br>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
