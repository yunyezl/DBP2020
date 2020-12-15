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
    'description' => '무슨 내용인가요 ...'
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
    <title> book </title>
</head>
<style>
a:link { color: green; text-decoration: none;}
a:visited { color: black; text-decoration: none;}
a:hover { color: blue; text-decoration: none;}
</style>
<body>
  <h1> <a href="index.php"> 기억에 남는 책</a> </h1>
  <ol>
    <!-- <li> MySQL </li> -->
    <?= $list ?>
  </ol>
  <a href="create.php">추가하기</a>
  <h2> <?= $article['title'] ?> </h2>
  <?= $article['description'] ?>
</body>
</html>
