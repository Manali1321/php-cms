<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {

  header('Location: social.php');
  die();

}

if (isset($_POST['name'])) {

  if ($_POST['name'] and $_POST['url']) {

    $query = 'UPDATE social_media SET
      name = "' . mysqli_real_escape_string($connect, $_POST['name']) . '",
      url = "' . mysqli_real_escape_string($connect, $_POST['url']) . '"
      WHERE id = ' . $_GET['id'] . '
      LIMIT 1';
    mysqli_query($connect, $query);
    set_message('Social media has been updated');

  }

  header('Location: social.php');
  die();

}


if (isset($_GET['id'])) {

  $query = 'SELECT *
    FROM social_media
    WHERE id = ' . $_GET['id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: social.php');
    die();

  }
  $record = mysqli_fetch_assoc($result);

}

include('includes/header.php');

?>

<h2>Edit Social</h2>

<form method="post">
  <label for="name">Name:::::</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities($record['name']); ?>">
  </br>
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities($record['url']); ?>">
  </br>
  <input type="submit" value="Edit Social_Media">

</form>

<p><a href="social.php"><i class="fas fa-arrow-circle-left"></i> Return to Social List</a></p>


<?php

include('includes/footer.php');

?>