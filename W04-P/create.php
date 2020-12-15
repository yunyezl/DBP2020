<?php
  $link = mysqli_connect('localhost', 'root', 'rnrn382756', 'dbp');
  $query = "SELECT * FROM book";
  $result = mysqli_query($link, $query);
  $list = '';
  $updated_link = '';

  while ($row = mysqli_fetch_array($result)) {
      // echo "<li>{$row['title']}</li>";
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array(
    'title' =>  'The book that I read impressively',
    'author' => 'Who\'s the writer?'
  );

  if (isset($_GET['id'])) {
      $query = "SELECT * FROM book WHERE id = {$_GET['id']}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
    'title' => $row['title'],
    'description' => $row['description']
  );
      $updated_link = '<a href="update.php?id'.$_GET['id'].'">update</a>';
  }

  $query = "SELECT * FROM author";
  $result = mysqli_query($link, $query);
  $select_form = '<select name = "author_id">';
  while ($row = mysqli_fetch_array($result)) {
      $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
  }
  $select_form .= '</select>';
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
    <!-- <li> MySQL </li> -->
    <?= $list ?>
  </ol>
  <form action="process_create.php" method="post">
    <p><input type="text" name="title" placeholder="title"></p>
    <p><textarea name="description" placeholder="description"></textarea></p>
    <?= $select_form?> <br>
    <p><input type="submit"></p>
  </form>
</center>
</body>
</html>
