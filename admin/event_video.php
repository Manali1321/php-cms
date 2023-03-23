<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['event_id'])) {

  header('Location: event.php');
  die();

}

if (isset($_FILES['video'])) {

  if (isset($_FILES['video'])) {

    if ($_FILES['video']['error'] == 0) {

      switch ($_FILES['video']['type']) {
        case 'video/mp4':
          $type = 'mp4';
          break;
        case 'video/ogg':
          $type = 'ogg';
          break;
        case 'video/webm':
          $type = 'webm';
          break;
      }

      $query = 'UPDATE event_details SET
        video = "data:video/' . $type . ';base64,' . base64_encode(file_get_contents($_FILES['video']['tmp_name'])) . '"
        WHERE event_id = ' . $_GET['event_id'] . '
        LIMIT 1';
      mysqli_query($connect, $query);

    }

  }

  set_message('Event video has been updated');

  header('Location: event.php');
  die();

}


if (isset($_GET['event_id'])) {

  if (isset($_GET['delete'])) {

    $query = 'UPDATE event_details SET
      video = ""
      WHERE event_id = ' . $_GET['event_id'] . '
      LIMIT 1';
    $result = mysqli_query($connect, $query);

    set_message('Event video has been deleted');

    header('Location: event.php');
    die();

  }

  $query = 'SELECT *
    FROM event_details
    WHERE event_id= ' . $_GET['event_id'] . '
    LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {

    header('Location: event.php');
    die();

  }

  $record = mysqli_fetch_assoc($result);

}

include('includes/header.php');

include 'includes/wideimage/WideImage.php';

?>

<h2>Edit Event</h2>

<p>
  Note: For best results, images should be approximately 800 x 800 pixels.
</p>

<?php if ($record['video']): ?>

  <?php

  $data = base64_decode(explode(',', $record['video'])[1]);
  $vdo = WideImage::loadFromString($data);
  $data = $vdo->resize(200, 200, 'outside')->crop('center', 'center', 200, 200)->asString('mp4', 70);

  ?>
  <p><img src="data:video/mp4;base64,<?php echo base64_encode($data); ?>" width="200" height="200"></p>
  <p><a href="event_video.php?event_id=<?php echo $_GET['event_id']; ?>&delete"><i class="fas fa-trash-alt"></i> Delete
      this
      Event</a></p>

<?php endif; ?>

<form method="post" enctype="multipart/form-data">

  <label for="video">Video:</label>
  <input type="file" name="video" id="video">

  <br>

  <input type="submit" value="Save video">

</form>

<p><a href="event.php"><i class="fas fa-arrow-circle-left"></i> Return to Event List</a></p>


<?php

include('includes/footer.php');

?>