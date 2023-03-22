<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['category_id'])) {

  header('Location: categories.php');
  die();

}

if (isset($_POST['name'])) {

  if ($_POST['name']) {


    $query = 'UPDATE categories SET
      name = "' . mysqli_real_escape_string($connect, $_POST['name']) . '"    
      WHERE category_id = ' . $_GET['category_id'] . '
      LIMIT 1';
    mysqli_query($connect, $query);
    set_message('Category has been updated');
  }

  header('Location: categories.php');
  die();

}


if (isset($_GET['category_id'])) {

  $query = 'SELECT *
    FROM categories
    WHERE category_id = ' . $_GET['category_id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: categories.php');
    die();

  }

  $record = mysqli_fetch_assoc($result);

}

include('includes/header.php');

?>

<h2>Edit Category</h2>

<form method="post">

  <label for="title">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities($record['name']); ?>">

  <br>

  <input type="submit" value="Edit Category">

</form>

<p><a href="categories.php"><i class="fas fa-arrow-circle-left"></i> Return to Category List</a></p>


<?php

include('includes/footer.php');

?>