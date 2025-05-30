<?php
class ClaimModel {
    private $mysqli;

    public function __construct(mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    // Insert new claim
    public function insertClaim(array $data): bool {
        $fields = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($fields), '?'));

        $sql = "INSERT INTO claims_online (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $types = $this->getParamTypes($data);
        $values = array_values($data);

        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Update claim by ID
    public function updateClaim(int $id, array $data): bool {
        $fields = array_keys($data);
        $setClause = implode('=?, ', $fields) . '=?';

        $sql = "UPDATE claims_online SET $setClause, updated_at = NOW() WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $types = $this->getParamTypes($data) . 'i';  // add 'i' for id
        $values = array_values($data);
        $values[] = $id;

        $stmt->bind_param($types, ...$values);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Delete claim by ID
    public function deleteClaim(int $id): bool {
        $sql = "DELETE FROM claims_online WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Helper function to get param types for bind_param
    private function getParamTypes(array $params): string {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_double($param) || is_float($param)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        return $types;
    }
}
