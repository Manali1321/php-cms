<?php

include('admin/includes/database.php');
include('admin/includes/config.php');
include('admin/includes/functions.php');

?>
<!doctype html>
<html>

<head>

  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

  <link href="styles.css" type="text/css" rel="stylesheet">

  <script src=""></script>

</head>

<body>
  <header>
    <h1>BashBliss</h1>
    <nav>
      <!-- <a href="/index.php">Home</a>
      <a href="/event.php">Event</a> -->
    </nav>
  </header>

  <?php

  $query = 'SELECT *
    FROM event_details';
  $result = mysqli_query($connect, $query);

  ?>

  <p>There are
    <?php echo mysqli_num_rows($result); ?> projects in the database!
  </p>

  <hr>

  <?php while ($record = mysqli_fetch_assoc($result)): ?>

    <div>

      <h2>
        <?php echo $record['title']; ?>
      </h2>
      <?php echo $record['content']; ?>

      <?php if ($record['photo']): ?>

        <p>The image can be inserted using a base64 image:</p>

        <img src="<?php echo $record['photo']; ?>">

        <p>Or by streaming the image through the image.php file:</p>

        <img src="admin/image.php?type=project&id=<?php echo $record['id']; ?>&width=100&height=100">

      <?php else: ?>

        <p>This record does not have an image!</p>

      <?php endif; ?>

    </div>

    <hr>

  <?php endwhile; ?>

</body>

</html>