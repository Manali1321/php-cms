<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM social_media
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Social media details has been deleted');

  header('Location: social.php');
  die();

}

include('includes/header.php');

$query = 'SELECT *
  FROM social_media
  ORDER BY id DESC';
$result = mysqli_query($connect, $query);

?>

<h2>Manage Social Details</h2>
<table>
  <tr>
    <!-- <th align="center">EventId</th> -->
    <th align="center">Name</th>
    <th align="center">Logo</th>
    <th align="center">Link</th>
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td align="left">
        <?php echo htmlentities($record['name']); ?>
      </td>
      <td align="center">
        <img src="image.php?type=logo&id=<?php echo $record['id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="left">
        <?php echo htmlentities($record['url']); ?>
      </td>
      <td align="center"><a href="social_photo.php?id=<?php echo $record['id']; ?>">Logo Details</a>
      </td>
      <td align="center"><a href="social_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="social.php?delete=<?php echo $record['id']; ?>"
          onclick="javascript:return confirm('Are you sure you want to delete <?php echo $record['name']; ?> social details?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>


<p><a href="social_add.php"><i class="fas fa-plus-square"></i> Add Social Details</a></p>


<?php

include('includes/footer.php');

?>