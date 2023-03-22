<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();
// *******Delete**********
if (isset($_GET['delete'])) {

  $query = 'DELETE FROM categories
    WHERE category_id = ' . $_GET['delete'] . '
    LIMIT 1';
  mysqli_query($connect, $query);

  // If there are existing joins, they should be deleted
  // here as well. 

  set_message('Category has been deleted');

  header('Location: categories.php');
  die();

}

include('includes/header.php');

$query = 'SELECT *
  FROM categories
  ORDER BY name ASC';
$result = mysqli_query($connect, $query);

?>

<h2>Manage Categories</h2>

<table>
  <tr>
    <th></th>
    <th align="left">Name</th>

  </tr>
  <?php while ($record = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td align="center">
        <img
          src="image.php?type=category&category_id=<?php echo $record['category_id']; ?>&width=300&height=300&format=inside">
      </td>
      <td align="left">
        <?php echo htmlentities($record['name']); ?>
      </td>
      <td align="center"><a href="categories_photo.php?category_id=<?php echo $record['category_id']; ?>">Photo</i></a>
      </td>
      <td align="center"><a href="categories_edit.php?category_id=<?php echo $record['category_id']; ?>">Edit</i></a></td>
      <td align="center">
        <a href="categories.php?delete=<?php echo $record['category_id']; ?>"
          onclick="javascript:confirm('Are you sure you want to delete <?php echo $record['name']; ?> categories?');">Delete</i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="categories_add.php"><i class="fas fa-plus-square"></i> Add Category</a></p>


<?php

include('includes/footer.php');

?>