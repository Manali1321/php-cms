<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

// Check to see if the form has been submitted
if (isset($_POST['name'])) {

  // Confirms required form data is complete
  if ($_POST['name']) {

    $query = 'INSERT INTO categories (
      name
    ) VALUES (
      "' . mysqli_real_escape_string($connect, $_POST['name']) . '"
    )';

    mysqli_query($connect, $query);

    set_message('Category has been added');

  }

  header('Location: categories.php');
  die();

}

include('includes/header.php');

?>

<h2>Add Category</h2>

<form method="post">

  <label for="name">Name:</label>
  <input type="text" name="name" id="name">

  <br>

  <input type="submit" value="Add Category">

</form>

<p><a href="categories.php"><i class="fas fa-arrow-circle-left"></i> Return to Category List</a></p>


<?php

include('includes/footer.php');

?>