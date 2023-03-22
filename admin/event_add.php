<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

// Check to see if the form has been submitted
if (isset($_POST['name'])) {

  // Confirms required form data is complete
  if ($_POST['name'] and $_POST['image']) {

    $query = 'INSERT INTO categories (
        name,
        image,
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['name']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['image']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Category has been added');

  }

  header('Location: categories.php');
  die();

}

include('includes/header.php');

?>

<h2>Add User</h2>

<form method="post">

  <label for="first">First Name:</label>
  <input type="text" name="first" id="first">

  <br>

  <label for="last">Last Name:</label>
  <input type="text" name="last" id="last">

  <br>

  <label for="email">Email:</label>
  <input type="email" name="email" id="email">

  <br>

  <label for="password">Password:</label>
  <input type="password" name="password" id="password">

  <br>

  <label for="active">Active:</label>
  <?php

  $values = array('Yes', 'No');

  echo '<select name="active" id="active">';
  foreach ($values as $key => $value) {
    echo '<option value="' . $value . '"';
    echo '>' . $value . '</option>';
  }
  echo '</select>';

  ?>

  <br>

  <input type="submit" value="Add User">

</form>

<p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>


<?php

include('includes/footer.php');

?>