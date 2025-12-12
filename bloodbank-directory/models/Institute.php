<?php
class Institute {
    private $conn;         
    private $table = "bloodbanks";  // Your actual table

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch ALL records (no pagination)
    public function getAll($filters = []) {

        $sql = "SELECT * FROM {$this->table} WHERE 1=1";

        // Apply filters
        if (!empty($filters['district'])) {
            $district = $this->conn->real_escape_string($filters['district']);
            $sql .= " AND district = '{$district}'";
        }

        if (!empty($filters['type']) && $filters['type'] !== "All") {
            $type = $this->conn->real_escape_string($filters['type']);
            $sql .= " AND type = '{$type}'";
        }

        if (isset($filters['hasContact']) && $filters['hasContact'] === 'yes') {
            $sql .= " AND COALESCE(contact,'') <> ''";
        }

        // Order alphabetically
        $sql .= " ORDER BY name ASC";

        $result = $this->conn->query($sql);
