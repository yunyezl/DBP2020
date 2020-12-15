<?php
  $link = mysqli_connect('localhost', 'root', 'rootroot', 'dbp');
  $query = "SELECT * FROM book";
  $result = mysqli_query($link, $query);
  $list = '';

  while($row = mysqli_fetch_array($result)){
     // echo "<li>{$row['title']}</li>";
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array(
    'title' => '책 읽자',
    'description' => '무슨 내용..?'
  );

  if( isset($_GET['id']) ){
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
  <h1> <a href="index.php"> 책 기록하기 </a> </h1>
  <ol>
    <!-- <li> MySQL </li> -->
    <?= $list ?>
  </ol>
  <form action="process_create.php" method="post">
    <p><input type="text" name="title" placeholder="title"></p>
    <p><textarea name="description" placeholder="description"></textarea></p>
    <p><input type="submit"></p>
  </form>
</center>
</body>
</html>
