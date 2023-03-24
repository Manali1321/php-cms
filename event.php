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

  <title>BashBliss</title>

  <link href="styles.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

</head>

<body>
  <header>
    <h1>BashBliss</h1>
    <nav>
      <a href="/php-cms/">Home</a>
      <a href="/php-cms/event.php">Event</a>
      <a href="/php-cms/about.php">About us</a>
    </nav>
  </header>

  <body>
    <main>
      <?php

      $query = 'SELECT * FROM event_details';
      $result = mysqli_query($connect, $query);

      ?>
      <h2>Events</h2>
      <?php while ($record = mysqli_fetch_assoc($result)): ?>

        <div>
          <h3>
            <?php echo $record['name'] ?>
          </h3>

          <img src="
            <?php echo $record['image']; ?>
          " alt="i am image" width="300" height="350">

          <p>
            <?php echo $record['details'] ?>
          </p>

          <video width="400" height="200" autoplay>
            <source src="<?php echo $record['video']; ?>
            " type="video/webm">I am video
          </video>
        </div>
      <?php endwhile; ?>

      <main>
        <footer>
        </footer>
  </body>

</html>