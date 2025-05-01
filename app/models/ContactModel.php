<?php
class ContactModel extends DB {

    public function softDelete($id)
    {
        $id = (int)$id; 
        $sql = "UPDATE Contact SET deleted = 1 WHERE ID = ?";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->bind_param("i", $id) && $stmt->execute();
    }

    public function getContactsFiltered($startDate = null, $endDate = null, $status = null, $limit = 10, $offset = 0) 
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Contact WHERE deleted = FALSE";
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
    
        $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";
    
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $contacts = [];
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
    
        $totalResult = $this->getConnection()->query("SELECT FOUND_ROWS() AS total");
        $total = $totalResult->fetch_assoc()['total'];
    
        return [
            "contacts" => $contacts,
            "total" => $total
        ];
    }

    public function updateStatusMulti($ids, $status)
    {
        if (empty($ids)) return false;

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $types = 's' . str_repeat('i', count($ids));
        $params = array_merge([$status], $ids);

        $sql = "UPDATE Contact SET Status = ? WHERE ID IN ($placeholders)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    public function deleteMulti($ids)
    {
        if (empty($ids)) return false;

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $types = str_repeat('i', count($ids));
        $sql = "UPDATE Contact SET deleted = 1 WHERE ID IN ($placeholders)";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param($types, ...$ids);
        return $stmt->execute();
    }

    public function getDeletedContacts($startDate, $endDate, $limit, $offset)
    {
        $conn = $this->getConnection();

        $query = "SELECT * FROM Contact WHERE deleted = 1";
        $params = [];
        $types = '';

        if ($startDate) {
            $query .= " AND created_at >= ?";
            $params[] = $startDate;
            $types .= 's';
        }

        if ($endDate) {
            $query .= " AND created_at <= ?";
            $params[] = $endDate;
            $types .= 's';
        }

        $countQuery = "SELECT COUNT(*) as total FROM ($query) as sub";
        $stmtCount = $conn->prepare($countQuery);
        if ($types) $stmtCount->bind_param($types, ...$params);
        $stmtCount->execute();
        $total = $stmtCount->get_result()->fetch_assoc()['total'];
        $stmtCount->close();

        $query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= 'ii';

        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $contacts = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return [
            'total' => $total,
            'contacts' => $contacts
        ];
    }

    public function restoreContact($id)
    {
        $sql = "UPDATE Contact SET deleted = 0 WHERE ID = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function deletePermanently($id)
    {
        $sql = "DELETE FROM Contact WHERE ID = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function restoreByIds($ids)
    {
        $placeholders = implode(",", array_fill(0, count($ids), "?"));
        $sql = "UPDATE Contact SET deleted = 0 WHERE ID IN ($placeholders)";
        $stmt = $this->getConnection()->prepare($sql);

        $types = str_repeat("i", count($ids));
        $stmt->bind_param($types, ...$ids);
        return $stmt->execute();
    }

    public function deletePermanentlyByIds($ids)
    {
        $placeholders = implode(",", array_fill(0, count($ids), "?"));
        $sql = "DELETE FROM Contact WHERE ID IN ($placeholders)";
        $stmt = $this->getConnection()->prepare($sql);

        $types = str_repeat("i", count($ids));
        $stmt->bind_param($types, ...$ids);
        return $stmt->execute();
    }
}