<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_POST['delete'])) {
  if (isset($_POST['delete'])) {

    $query = 'DELETE FROM users
      WHERE id = ' . $_POST['delete'] . '
      LIMIT 1';
    mysqli_query($connect, $query);

    set_message('User has been deleted');

    header('Location: users.php');
    die();

  } else {
    set_message('No update');

  }
}

include('includes/header.php');

$query = 'SELECT *
  FROM users 
  ' . (($_SESSION['id'] != 1 and $_SESSION['id'] != 4) ? 'WHERE id = ' . $_SESSION['id'] . ' ' : '') . '
  ORDER BY last,first';
$result = mysqli_query($connect, $query);

?>

<h2>Manage Users</h2>

<table>
  <tr>
    <th align="center">ID</th>
    <th align="left">Name</th>
    <th align="left">Email</th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td align="center">
        <?php echo $record['id']; ?>
      </td>
      <td align="left">
        <?php echo htmlentities($record['first']); ?>
        <?php echo htmlentities($record['last']); ?>
      </td>
      <td align="left"><a href="mailto:<?php echo htmlentities($record['email']); ?>"><?php echo htmlentities($record['email']); ?></a></td>
      <td align="center"><a href="users_edit.php?id=<?php echo $record['id']; ?>">Edit</a></td>
      <td align="center">
        <?php if ($_SESSION['id'] != $record['id']): ?>
          <form method="POST" action="users.php">
            <input type="hidden" name="delete_id" value="<?php echo $record['id']; ?>">
            <input type="submit" name="delete_confirm" value="delete"
              onclick="return confirm('Are you sure you want to delete this user?');">
          </form>
        <?php endif; ?>
      </td>
      <td align="center">
        <?php echo $record['active']; ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="users_add.php"><i class="fas fa-plus-square"></i> Add User</a></p>


<?php

include('includes/footer.php');

?>