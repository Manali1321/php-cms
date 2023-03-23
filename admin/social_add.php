<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

// Check to see if the form has been submitted
if (isset($_POST['name'])) {

  // Confirms required form data is complete
  if ($_POST['name'] and $_POST['url']) {

    $query = 'INSERT INTO social_media (
        name,
        url
      ) VALUES (
         "' . mysqli_real_escape_string($connect, $_POST['name']) . '",
         "' . mysqli_real_escape_string($connect, $_POST['url']) . '"
      )';
    mysqli_query($connect, $query);

    set_message('Social media has been added');

  }

  header('Location: social.php');
  die();

}

include('includes/header.php');

?>

<h2>Add Social Details</h2>

<form method="post">

  <label for="name">Name:</label>
  <input type="text" name="name" id="name">

  <br>

  <label for="url">URL:</label>
  <input type="text" name="url" id="url">

  <br>

  <input type="submit" value="Add Social">

</form>

<p><a href="social.php"><i class="fas fa-arrow-circle-left"></i> Return to Social List</a></p>


<?php

include('includes/footer.php');

?>