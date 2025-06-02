<?php
require_once __DIR__ . '/../config/db.php';

$telegram_token = '1728711438:AAEwG-o5dqHGAeBy6bf3Z-uCLwEtNBUwh7g';
$chat_id = '-1001642640133';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_type = $_POST['product_type'] ?? '';

    if (empty($product_type)) {
        die("Product type is required.");
    }

    // Initialize variables
    $customer_name = '';
    $vehicle_type = null;
    $vehicle_model = null;
    $vehicle_price = null;
    $vehicle_plate = null;
    $engine_power = null;
    $seat_count = null;
    $phone = null;
    $email = null;
    $additional_info = null;

    if ($product_type === 'auto') {
        $customer_name = mysqli_real_escape_string($connection, $_POST['customer_name'] ?? '');
        $vehicle_type = mysqli_real_escape_string($connection, $_POST['vehicle_type'] ?? '');
        $vehicle_model = mysqli_real_escape_string($connection, $_POST['vehicle_model'] ?? '');
        $vehicle_price = floatval($_POST['vehicle_price'] ?? 0);
        $vehicle_plate = mysqli_real_escape_string($connection, $_POST['vehicle_plate'] ?? '');
        $engine_power = mysqli_real_escape_string($connection, $_POST['engine_power'] ?? '');
        $seat_count = intval($_POST['seat_count'] ?? 0);
        $phone = mysqli_real_escape_string($connection, $_POST['phone'] ?? '');
        $email = mysqli_real_escape_string($connection, $_POST['email'] ?? '');
        $additional_info = mysqli_real_escape_string($connection, $_POST['additional_info'] ?? '');

        if (empty($customer_name)) {
            die("Customer name is required for auto insurance.");
        }
    } else {
        $customer_name = mysqli_real_escape_string($connection, $_POST['other_customer_name'] ?? '');
        $phone = mysqli_real_escape_string($connection, $_POST['phone'] ?? '');
        $email = mysqli_real_escape_string($connection, $_POST['email'] ?? '');
        $additional_info = mysqli_real_escape_string($connection, $_POST['additional_info'] ?? '');

        if (empty($customer_name) || empty($phone) || empty($email)) {
            die("Customer name, phone and email are required for this product type.");
        }
    }

    // Helper function for SQL NULL handling
    function sqlVal($val) {
        return ($val === '' || $val === null) ? "NULL" : "'" . $val . "'";
    }

    $sql = "INSERT INTO request_quote_online 
        (product_type, customer_name, vehicle_type, vehicle_model, vehicle_price, vehicle_plate, engine_power, seat_count, phone, email, additional_info) VALUES
        (" .
        sqlVal($product_type) . ", " .
        sqlVal($customer_name) . ", " .
        sqlVal($vehicle_type) . ", " .
        sqlVal($vehicle_model) . ", " .
        ($vehicle_price ? $vehicle_price : "NULL") . ", " .
        sqlVal($vehicle_plate) . ", " .
        sqlVal($engine_power) . ", " .
        ($seat_count ? $seat_count : "NULL") . ", " .
        sqlVal($phone) . ", " .
        sqlVal($email) . ", " .
        sqlVal($additional_info) .
        ")";

    if (mysqli_query($connection, $sql)) {
        // Prepare Telegram message text
        $message = "New Insurance Quote Request\n";
        $message .= "Product Type: $product_type\n";
        $message .= "Customer Name: $customer_name\n";
        $message .= "Phone: " . ($phone ?: "N/A") . "\n";
        $message .= "Email: " . ($email ?: "N/A") . "\n";
        $message .= "Additional Info: " . ($additional_info ?: "N/A") . "\n";

        if ($product_type === 'auto') {
            $message .= "Vehicle Type: " . ($vehicle_type ?: "N/A") . "\n";
            $message .= "Vehicle Model: " . ($vehicle_model ?: "N/A") . "\n";
            $message .= "Vehicle Price: " . ($vehicle_price ?: "N/A") . "\n";
            $message .= "Vehicle Plate: " . ($vehicle_plate ?: "N/A") . "\n";
            $message .= "Engine Power: " . ($engine_power ?: "N/A") . "\n";
            $message .= "Seat Count: " . ($seat_count ?: "N/A") . "\n";
        }

        // Send Telegram notification
        $url = "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$chat_id&text=" . urlencode($message);
        file_get_contents($url);

        // Redirect back with success
        header("Location: ../request-quote?success=1");
        exit;
    } else {
        die("Error saving quote: " . mysqli_error($connection));
    }
} else {
    die("Invalid request.");
}
