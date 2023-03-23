<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

// Check to see if the form has been submitted
if (isset($_POST['category_id'])) {

  // Confirms required form data is complete
  if ($_POST['category_id'] and $_POST['details']) {

    $query = 'INSERT INTO event_details (
        category_id,
        details
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['category_id']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['details']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Event has been added');

  }

  header('Location: event.php');
  die();

}

// Retrieve the list of categories from the database
$category_query = 'SELECT category_id, name FROM categories';
$category_result = mysqli_query($connect, $category_query);
include('includes/header.php');

?>

<h2>Add Event</h2>

<form method="post">


  <label for="category_id">Category:</label>
  <select name="category_id" id="category_id">
    <?php while ($row = mysqli_fetch_assoc($category_result)) { ?>
      <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>
    <?php } ?>
  </select>

  <br>

  <label for="details">Details:</label>
  <input type="text" name="details" id="details">

  <br>

  <input type="submit" value="Add Event">

</form>

<p><a href="event.php"><i class="fas fa-arrow-circle-left"></i> Return to Event List</a></p>


<?php

include('includes/footer.php');

?>