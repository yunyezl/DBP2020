<?php
  $link = mysqli_connect('localhost', 'root', 'rootroot', 'dbp');
  $query = "SELECT * FROM book";
  $result = mysqli_query($link, $query);
  $list = '';

  while ($row = mysqli_fetch_array($result)) {
      // echo "<li>{$row['title']}</li>";
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array(
    'title' =>  'The title of a book',
    'author' => 'Who\'s the writer'
  );

    $update_link = '';
    $delete_link = '';

  if (isset($_GET['id'])) {
      $query = "SELECT * FROM book WHERE id = {$_GET['id']}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
    'title' => $row['title'],
    'author' => $row['author']
  );
      $update_link = '<a href="update.php?id='.$_GET['id'].'">modify</a>';
      $delete_link = '<form action="process_delete.php" method="POST">
          <input type="hidden" name="id" value="'.$_GET['id'].'">
          <input type="submit" value="delete">
        </form>
      ';
  }
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <title> book </title>
</head>
<style>
a:link { text-decoration: none;}
a:visited { color: black; text-decoration: none;}

</style>
<body>
  <h1> <a href="index.php"> An impressive book to me :) </a> </h1>
  <ol>
    <?= $list ?>
  </ol>
  <a href="create.php">add</a>
  <?=$update_link?>
  <?=$delete_link?>
  <h2> <?= $article['title'] ?> </h2>
  <?= $article['author'] ?>
</body>
</html>
