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
    $category_query = 'SELECT category_id, name FROM categories';
    $category_result = mysqli_query($connect, $category_query);

    ?>
    <div class="intro">
      <p>Are you ready to create an unforgettable event that your guests will be talking about for years to
        come? Whether
        you're planning a birthday party, anniversary celebration, or festival-themed event, our team of experienced
        event
        planners is here to help. By filling out our free consultation form, you'll get one step closer to creating the
        event of your dreams. Our team will work with you every step of the way, from developing a personalized plan to
        executing every detail with precision and care. So why wait? Fill out our form today and let's get started on
        making your event vision a reality!</p>
    </div>
    <section id="form">
      <form method="post" class="arrange">
        <fieldset>
          <legend>Sign up TODAY</legend>
          <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="field" required>
          </div>
          <br>
          <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="field" required>
          </div>
          <br>
          <div>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" class="field" required>
          </div>
          <br>
          <div>
            <label for="category_id">Event:</label>
            <select name="category_id" class="field">
              <?php while ($row = mysqli_fetch_assoc($category_result)) { ?>
                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <br>
          <div>
            <input type="submit" value="Sign Up" class="btn">
          </div>
        </fieldset>

      </form>
    </section>
    <div>
      <?php

      $query_social = 'SELECT * FROM social_media';
      $result_social = mysqli_query($connect, $query_social);

      ?>
      <h2>Get update of our Work</h2>

      <div>
        <?php while ($record_social = mysqli_fetch_assoc($result_social)): ?>
          <a href="<?php echo $record_social['url']; ?>"><img src="
            <?php echo $record['logo']; ?>
          " alt="i am image" width="100" height="100"></a>
        <?php endwhile; ?>
      </div>
    </div>
  </main>
  <footer>
    <p>manaliPatel, March 2023</p>
  </footer>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  <script src="./index.js" async defer></script>
</body>

</html>