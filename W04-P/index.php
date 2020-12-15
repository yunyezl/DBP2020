<?php
  $link = mysqli_connect('localhost', 'root', 'rnrn382756', 'dbp');
  $query = "SELECT * FROM book";
  $result = mysqli_query($link, $query);
  $list = '';

  while ($row = mysqli_fetch_array($result)) {
      // echo "<li>{$row['title']}</li>";
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array(
    'title' =>  'The title of a book',
    'description' => 'What is it about?'
  );

    $update_link = '';
    $delete_link = '';
    $author ='';

  if (isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
      $query = "SELECT * FROM book LEFT JOIN author ON book.author_id = author.id WHERE book.id ={$filtered_id}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article['title'] = htmlspecialchars($row['title']);
      $article['description'] = htmlspecialchars($row['description']);
      $article['title'] = htmlspecialchars($row['title']);
      $article['description'] = htmlspecialchars($row['description']);
      $article['name'] = htmlspecialchars($row['name']);
      $update_link = '<a href="update.php?id='.$_GET['id'].'">modify</a>';
      $delete_link = '<form action="process_delete.php" method="POST">
          <input type="hidden" name="id" value="'.$_GET['id'].'">
          <input type="submit" value="delete">
        </form>
      ';
      $author = "<p>by {$article['name']}</p>";
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
  <a href="author.php"> author </a>
  <ol>
    <?= $list ?>
  </ol>
  <a href="create.php">add</a>

  <?=$update_link?>
  <?=$delete_link?>
  <h2> <?= $article['title'] ?> </h2>
  <?= $article['description'] ?>
  <?= $author ?>
</body>
</html>
