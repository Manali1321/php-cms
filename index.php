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


</head>

<body>
  <header>
    <h1>BashBliss</h1>
    <nav>
      <ul>
        <li>
          <a href="/php-cms/">Home</a>
        </li>
        <li>
          <a href="/php-cms/event.php">Event</a>
        </li>
        <li>
          <a href="/php-cms/about.php">About us</a>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    <?php

    $query = 'SELECT * FROM categories';
    $result = mysqli_query($connect, $query);

    ?>
    <div class="intro">
      <p>“Welcome to our event management system! We are here to help you make your special day even more
        memorable. Our
        team of experts will work with you to create a unique and personalized experience that reflects your style and
        personality. Whether it’s a birthday party, anniversary celebration or date night, we’ve got you covered.
        Contact
        us today to start planning your dream event!”</p>
    </div>
    <section>
      <h2>Events</h2>
      <div id='category' class="arrange">
        <?php while ($record = mysqli_fetch_assoc($result)): ?>
          <a href="/php-cms/event.php?name=<?php echo urlencode($record['name']); ?>">
            <div id='category-item'>
              <img src="
            <?php echo $record['image']; ?>
          " alt="i am image" width="300" height="350">
              <h3>
                <?php echo $record['name'] ?>
              </h3>
            </div>
          </a>
        <?php endwhile; ?>
      </div>
    </section>
    <div class="intro">
      <p>“We also offer free consultation services for customer events so that we can help you plan your
        dream event
        exactly as you want it.”</p>
    </div>
    <a href="/php-cms/about.php"><button class="btn">Consult With Our Expert<button></a>

  </main>
  <footer>
    <p>manaliPatel, March 2023</p>
  </footer>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  <script src="./index.js" async defer></script>
</body>

</html>