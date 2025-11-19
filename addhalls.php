<?php
include 'DB/config.php';

$name = $_POST['name'];
$address = $_POST['address'];
$description = $_POST['description'];
$price = $_POST['price'];
$vendor_id = 1; // assuming current admin/vendor
$availability = 1;
$image = 50;

$sql = "INSERT INTO halls (name, address, description, price, vendor_id, availability, image)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiiii", $name, $address, $description, $price, $vendor_id, $availability, $image);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
