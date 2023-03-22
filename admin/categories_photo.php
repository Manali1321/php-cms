<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['category_id'])) {

  header('Location: categories.php');
  die();

}

if (isset($_FILES['image'])) {

  if (isset($_FILES['image'])) {

    if ($_FILES['image']['error'] == 0) {

      switch ($_FILES['image']['type']) {
        case 'image/png':
          $type = 'png';
          break;
        case 'image/jpg':
        case 'image/jpeg':
          $type = 'jpeg';
          break;
        case 'image/gif':
          $type = 'gif';
          break;
      }

      $query = 'UPDATE categories SET
        image = "data:image/' . $type . ';base64,' . base64_encode(file_get_contents($_FILES['image']['tmp_name'])) . '"
        WHERE category_id = ' . $_GET['category_id'] . '
        LIMIT 1';
      mysqli_query($connect, $query);

    }

  }

  set_message('Category image has been updated');

  header('Location: categories.php');
  die();

}


if (isset($_GET['category_id'])) {

  if (isset($_GET['delete'])) {

    $query = 'UPDATE categories SET
      image = ""
      WHERE category_id = ' . $_GET['category_id'] . '
      LIMIT 1';
    $result = mysqli_query($connect, $query);

    set_message('Category image has been deleted');

    header('Location: categories.php');
    die();

  }

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

include 'includes/wideimage/WideImage.php';

?>

<h2>Edit Category</h2>

<p>
  Note: For best results, images should be approximately 800 x 800 pixels.
</p>

<?php if ($record['image']): ?>

  <?php

  $data = base64_decode(explode(',', $record['image'])[1]);
  $img = WideImage::loadFromString($data);
  $data = $img->resize(200, 200, 'outside')->crop('center', 'center', 200, 200)->asString('jpg', 70);

  ?>
  <p><img src="data:image/jpg;base64,<?php echo base64_encode($data); ?>" width="200" height="200"></p>
  <p><a href="categories_photo.php?category_id=<?php echo $_GET['category_id']; ?>&delete"><i
        class="fas fa-trash-alt"></i> Delete this
      Photo</a></p>

<?php endif; ?>

<form method="post" enctype="multipart/form-data">

  <label for="image">Image:</label>
  <input type="file" name="image" id="image">

  <br>

  <input type="submit" value="Save image">

</form>

<p><a href="categories.php"><i class="fas fa-arrow-circle-left"></i> Return to Category List</a></p>


<?php

include('includes/footer.php');

?>