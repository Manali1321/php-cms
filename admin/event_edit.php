<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['event_id'])) {

  header('Location: event.php');
  die();

}

if (isset($_POST['category_id'])) {

  if ($_POST['category_id'] and $_POST['details']) {

    $query = 'UPDATE event_details SET
      category_id = "' . mysqli_real_escape_string($connect, $_POST['category_id']) . '",
      details = "' . mysqli_real_escape_string($connect, $_POST['details']) . '"
      WHERE event_id = ' . $_GET['event_id'] . '
      LIMIT 1';
    mysqli_query($connect, $query);
    set_message('Event has been updated');

  }

  header('Location: event.php');
  die();

}


if (isset($_GET['event_id'])) {

  $query = 'SELECT *
    FROM event_details
    WHERE event_id = ' . $_GET['event_id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: event.php');
    die();

  }
  $record = mysqli_fetch_assoc($result);

}

include('includes/header.php');

?>

<h2>Edit Event</h2>

<form method="post">

  <label for="title">Category Iddddd</label>
  <input type="number" name="category_id" id="category_id" value="<?php echo htmlentities($record['category_id']); ?>">
  </br>
  <label for="details">Details:</label>
  <input type="text" name="details" id="details" value="<?php echo htmlentities($record['details']); ?>">
  </br>
  <input type="submit" value="Edit Category">

</form>

<p><a href="event.php"><i class="fas fa-arrow-circle-left"></i> Return to Event List</a></p>


<?php

include('includes/footer.php');

?>