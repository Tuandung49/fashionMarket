<?php
include 'promo_connect.php';
$result = mysqli_query($conn, "SELECT * FROM promo_code");
?>
<table>
  <tr>
    <th>Code</th><th>Discount</th><th>Used</th><th>Limit</th><th>Start</th><th>End</th><th>Status</th><th>Actions</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= htmlspecialchars($row['code']) ?></td>
      <td><?= $row['discount'] ?>%</td>
      <td><?= $row['time_use'] ?>/<?= $row['limited'] ?></td>
      <td><?= $row['start_time'] ?></td>
      <td><?= $row['end_time'] ?></td>
      <td><?= $row['active'] ? 'Active' : 'Inactive' ?></td>
      <td>
        <a href="edit_promo.php?id=<?= $row['promo_code_id'] ?>">Edit</a> | 
        <a href="delete_promo.php?id=<?= $row['promo_code_id'] ?>" onclick="return confirm('Delete this promo?')">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>
<a href="add_promo.php">Add New Promo</a>
