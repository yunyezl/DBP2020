<?php
  $link = mysqli_connect('localhost', 'root', 'rnrn382756', 'dbp');
  $query = "SELECT * FROM book";
  $result = mysqli_query($link, $query);
  $list = '';

  while ($row = mysqli_fetch_array($result)) {
      // echo "<li>{$row['title']}</li>";
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }


  if (isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
      $query = "SELECT * FROM book WHERE id = {$_GET['id']}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
    'title' => $row['title'],
    'description' => $row['description']
  );
  }
 ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <title> DATABASE </title>
</head>
<style>
a:link { color: green; text-decoration: none;}
a:visited { color: black; text-decoration: none;}
a:hover { color: blue; text-decoration: none;}
</style>
<body>
  <h1> <a href="index.php"> Please write down the book you read impressively! </a> </h1>
  <ol>
    <?= $list ?>
  </ol>
  <form action="process_update.php" method="POST">
    <input type="hidden" name="id" value="<?= $filtered_id ?>">
    <p><input type="text" name="title" placeholder="title" value="<?= $article['title']?>"></p>
    <p><textarea name="description" placeholder="description"><?= $article['description']?></textarea></p>
    <p><input type="submit"></p>
  </form>
</center>
</body>
</html>
