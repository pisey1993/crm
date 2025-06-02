<?php
session_start();
header('Content-Type: application/json; charset=utf-8'); // changed to application/json for proper JSON response

// Include your DB connection
include '../config/db.php'; // This should define $connection (MySQLi)

if (!isset($connection)) {
    echo json_encode([
        'status_code' => 0,
        'message' => 'Database connection not available.'
    ]);
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
        echo json_encode([
            'status_code' => 0,
            'message' => "Prepare failed: " . $connection->error
        ]);
        exit;
    }

    // Bind the parameter and execute
    $stmt->bind_param("s", $policy);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Save entire policy data to session
        $_SESSION['policy_number'] = $policy;

        $fromDate = $row['insurance_period_from'];
        $toDate = $row['insurance_period_to'];
        $today = date('Y-m-d');

        if ($fromDate && $toDate && $today >= $fromDate && $today <= $toDate) {
            $response['status_code'] = 1;
            $response['message'] = '✅ Policy is valid.';
        } else {
            $response['status_code'] = 0;
            $response['message'] = "❌ Policy expired.\n\nPlease contact our sales team as below:<br>"
                . "+855 15 78 00 78<br>"
                . "+855 23 21 78 78<br><br>"
                . "info@peoplenpartners.com<br>"
                . "Building No. 7E, Mao Tse Toung Blvd., Sangkat Boeng Keng Kang 1,<br>"
                . "Khan Boeng Keng Kang, Phnom Penh, Cambodia.";


        }
    } else {
        $response['message'] = '❗ Policy not found. Please type in your policy correctly.';

        $_SESSION['policy_number'] = '';
    }

    echo json_encode($response);
    $stmt->close();
} else {
    echo json_encode($response);
}
