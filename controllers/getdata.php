<?php
header('Content-Type: text/plain; charset=utf-8');

// Include your DB connection
include '../config/db.php'; // This should define $connection (MySQLi)

if (!isset($connection)) {
    echo "Database connection not available.";
    exit;
}
$response = [
    'status_code' => 0,
    'message' => 'No POST data received.'
];

// Check if POST data is received
if (isset($_POST['policy_number_check'])) {
    $policy = $_POST['policy_number_check'];

    // Prepare the SQL statement
    $stmt = $connection->prepare("SELECT * FROM quote_policies WHERE policy_no = ?");
    if (!$stmt) {
        echo "Prepare failed: " . $connection->error;
        exit;
    }

    // Bind the parameter and execute
    $stmt->bind_param("s", $policy);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $fromDate = $row['insurance_period_from'];
        $toDate   = $row['insurance_period_to'];
        $today    = date('Y-m-d');

        if ($fromDate && $toDate && $today >= $fromDate && $today <= $toDate) {
            $response['status_code'] = 1;
            $response['message'] = '✅ Policy is valid.';
        } else {
            $response['status_code'] = 0;
            $response['message'] = '❌ Policy expired.';
        }
    } else {
        $response['message'] = '❗ Policy not found. Please type in your policy correctly.';
    }
    echo json_encode($response);
    $stmt->close();
} else {
    echo "No POST data received.";
}
