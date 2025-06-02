<?php
include '../config/db.php'; // This defines $connection

// Make sure the session variable is set
if (!isset($_SESSION['policy_number'])) {
    die("Policy number is not set in session.");
}

$session_policy = $_SESSION['policy_number'];

$sql = "SELECT clients.insured_name
        FROM clients
        INNER JOIN quote_policies ON quote_policies.client_id = clients.id
        WHERE Policy_no = ?
        LIMIT 1";

$stmt = $connection->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $connection->error);
}

$stmt->bind_param("s", $session_policy);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $insuredName = $row['insured_name'];
} else {
    echo "No record found.";
}

$stmt->close();
$connection->close();
?>
