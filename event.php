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
  <header class="arrange">
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

    if (!isset($_GET['name'])) {

      $query = 'SELECT * FROM event_details';
      $result = mysqli_query($connect, $query);

      if (mysqli_num_rows($result) == 0) {

        // if database empty
        echo "No events found";
      } else {

        // If the query is successful and return at least one result, display the event info
        ?>
        <div id="event_container">
          <h2>Events</h2>
          <?php while ($record = mysqli_fetch_assoc($result)): ?>
            <div id="event_detail">

              <img src="<?php echo $record['image']; ?>" alt="i am image" width="300" height="350">
              <div id="event">
                <video width="400" height="200" autoplay>
                  <source src="<?php echo $record['video']; ?>" type="video/webm">I am video
                </video>
                <p>
                  <?php echo $record['details'] ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
        <?php
      }
    } else {

      // This is for if user click on any image on event it take name ?name= and pass in to sql query
      $eventName = $_GET['name'];
      $filter_query = "SELECT * FROM event_details WHERE category_id=( SELECT category_id FROM categories WHERE name = '$eventName')";
      $result = mysqli_query($connect, $filter_query);

      if (mysqli_num_rows($result) == 0) {

        // If the query returns no results
        // display a message indicating that particular name no any event in event_details
        echo "Event not found";

      } else {

        // If the query is successful and returns at least one result, display the event details
    
        ?>
        <div id="event_container">
          <h2>Events</h2>
          <?php while ($record = mysqli_fetch_assoc($result)): ?>
            <div id="event_detail">

              <img src="<?php echo $record['image']; ?>" alt="i am image" width="300" height="350">
              <div id="event">
                <video width="400" height="200" autoplay>
                  <source src="<?php echo $record['video']; ?>" type="video/webm">I am video
                </video>
                <p>
                  <?php echo $record['details'] ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
        <?php
      }
    }
    ?>
  </main>
  <footer>
    <p>manaliPatel, March 2023</p>
  </footer>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  <script src="./index.js" async defer></script>
</body>

</html>