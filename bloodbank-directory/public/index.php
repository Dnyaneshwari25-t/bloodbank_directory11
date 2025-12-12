<?php
include '../config/db.php'; // your DB connection

// --- Filters ---
$district = isset($_GET['district']) ? $_GET['district'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$contact = isset($_GET['contact']) ? $_GET['contact'] : '';

// --- Base SQL ---
$sql = "SELECT * FROM institutes WHERE 1=1";

// Apply filters
if ($district != '') {
    $safeDistrict = $conn->real_escape_string($district);
    $sql .= " AND location LIKE '%$safeDistrict%'";
}

if ($type != '') {
    $safeType = $conn->real_escape_string($type);
    $sql .= " AND type = '$safeType'";
}

if ($contact == 'yes') {
    $sql .= " AND contact != '' AND contact != '0'";
}

// --- FINAL: NO LIMIT, NO OFFSET → Fetch ALL DATA ---
$sql .= " ORDER BY name ASC";

$result = $conn->query($sql);
$data = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blood Institutes</title>
</head>
<body>

<h2>Blood Institutes List</h2>

<!-- Filter Form -->
<form method="GET">
    District:
    <input type="text" name="district" value="<?= htmlspecialchars($district) ?>">

    Type:
    <select name="type">
        <option value="">All</option>
        <option value="Camps" <?= $type == 'Camps' ? 'selected' : '' ?>>Camps</option>
        <option value="Hospital" <?= $type == 'Hospital' ? 'selected' : '' ?>>Hospital</option>
        <option value="Clinic" <?= $type == 'Clinic' ? 'selected' : '' ?>>Clinic</option>
    </select>

    Contact Available:
    <select name="contact">
        <option value="">All</option>
        <option value="yes" <?= $contact == 'yes' ? 'selected' : '' ?>>Yes</option>
    </select>

    <button type="submit">Filter</button>
</form>

<!-- Table -->
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Location</th>
        <th>Contact</th>
    </tr>

    <?php if (count($data) > 0): ?>
        <?php foreach($data as $row): ?>
            <tr>
                <td><?= $row['public_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['location'] ?></td>
                <td><?= $row['contact'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No records found</td>
        </tr>
    <?php endif; ?>
</table>

<!-- Pagination removed completely -->

</body>
</html>
