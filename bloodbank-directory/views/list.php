<?php
// views/list.php
// expects $rows (array)
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blood Bank Directory</title>
  <style>
    body{font-family:Arial;padding:20px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:8px;border:1px solid #ddd;text-align:left}
  </style>
</head>
<body>
  <h1>Blood Bank Directory</h1>
  <table>
    <thead>
      <tr>
        <th>Public ID</th><th>Name</th><th>Type</th><th>Location</th><th>Contact</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($rows)): ?>
        <tr><td colspan="5">No rows found.</td></tr>
      <?php else: foreach ($rows as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['public_id']) ?></td>
          <td><?= htmlspecialchars($r['name']) ?></td>
          <td><?= htmlspecialchars($r['type']) ?></td>
          <td><?= htmlspecialchars($r['location']) ?></td>
          <td><?= htmlspecialchars($r['contact']) ?></td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</body>
</html>
