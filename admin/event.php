<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

  $query = 'DELETE FROM event_details
    WHERE event_id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  set_message('Event details has been deleted');

  header('Location: event.php');
  die();

}

include('includes/header.php');

$query = 'SELECT *
  FROM event_details
  ORDER BY event_id DESC';
$result = mysqli_query($connect, $query);

?>

<h2>Manage Event Details</h2>
<table>
  <tr>
    <th align="center">EventId</th>
    <th align="center">CategoryId</th>
    <th align="center">Image</th>
    <th align="center">Video</th>
    <th align="center">Details</th>
  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td align="left">
        <?php echo htmlentities($record['event_id']); ?>
      </td>
      <td align="left">
        <?php echo htmlentities($record['category_id']); ?>
      </td>
      <td align="center">
        <img src="image.php?type=event&event_id=<?php echo $record['event_id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="center">
        <img src="image.php?type=video&event_id=<?php echo $record['event_id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="left">
        <?php echo htmlentities($record['details']); ?>
      </td>
      <td align="center"><a href="event_photo.php?event_id=<?php echo $record['event_id']; ?>">Photo Details</a>
      </td>
      <td align="center"><a href="event_photo.php?event_id=<?php echo $record['event_id']; ?>">Video Details</a>
      </td>
      <td align="center"><a href="event_edit.php?event_id=<?php echo $record['event_id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="event.php?delete=<?php echo $record['event_id']; ?>"
          onclick="javascript:return confirm('Are you sure you want to delete <?php echo $record['details']; ?> event?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>


<p><a href="event_add.php"><i class="fas fa-plus-square"></i> Add Event Details</a></p>


<?php

include('includes/footer.php');

?>