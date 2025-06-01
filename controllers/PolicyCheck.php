<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include '../config/db.php'; // Your DB connection

$response = [
    'status_code' => 0,
    'message' => 'No policy number provided.'
];

if (isset($_POST['policy_number_check']) && !empty(trim($_POST['policy_number_check']))) {
    $policy_number = trim($_POST['policy_number_check']);

    $sql = "
        SELECT 
            qp.*,
            l.*,
            c.*
        FROM quote_policies qp
        LEFT JOIN locations l ON l.quote_policy_id = qp.id
        LEFT JOIN coverages c ON c.location_id = l.id
        WHERE qp.policy_no = ?
        LIMIT 1
    ";

    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("s", $policy_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Format dates inside $row if you want (optional)
            if (!empty($row['insurance_period_from'])) {
                $row['insurance_period_from'] = date('d/M/Y', strtotime($row['insurance_period_from']));
            }
            if (!empty($row['insurance_period_to'])) {
                $row['insurance_period_to'] = date('d/M/Y', strtotime($row['insurance_period_to']));
            }
            if (!empty($row['issue_date'])) {
                $row['issue_date'] = date('d/M/Y', strtotime($row['issue_date']));
            }

            // Add status_message for convenience
            $row['status_message'] = ($row['status'] == 1) ? 'Active' : 'Inactive';

            $response['status_code'] = 1;
            $response['message'] = 'Policy found.';
            $response['data'] = $row;
        } else {
            $response['message'] = 'Policy not found.';
        }

        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare database query: ' . $connection->error;
    }
} else {
    $response['message'] = 'Policy number is required.';
}

$connection->close();

echo json_encode($response);
exit;
