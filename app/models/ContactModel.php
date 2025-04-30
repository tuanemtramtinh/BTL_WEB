<?php
class ContactModel extends DB {
    public function softDelete($id)
    {
        $id = (int)$id; 
        $sql = "UPDATE Contact SET deleted = 1 WHERE ID = ?";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->bind_param("i", $id) && $stmt->execute();
    }

    public function getContactsFiltered($startDate = null, $endDate = null, $status = null) {
        $sql = "SELECT * FROM Contact WHERE deleted = FALSE";
        $params = [];
        $types = "";

        if ($startDate) {
            $sql .= " AND created_at >= ?";
            $params[] = $startDate . " 00:00:00";
            $types .= "s";
        }

        if ($endDate) {
            $sql .= " AND created_at <= ?";
            $params[] = $endDate . " 23:59:59";
            $types .= "s";
        }

        if ($status) {
            $sql .= " AND Status = ?";
            $params[] = $status;
            $types .= "s";
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->getConnection()->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $contacts = [];
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        return $contacts;
    }
}
