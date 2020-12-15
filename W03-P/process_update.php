<?php
  // var_dump($_POST);
  $link = mysqli_connect("localhost", "root", "rootroot", "dbp");

  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id']),
    'title' => mysqli_real_escape_string($link, $_POST['title']),
    'author' => mysqli_real_escape_string($link, $_POST['author'])
  );

  $query = "
    UPDATE book SET title = '{$filtered['title']}', author = '{$filtered['author']}' WHERE id = '{$filtered['id']}'
  ";

  $result = mysqli_query($link, $query);
  if ($result == false) {
      echo '수정하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      echo mysqli_error($link);
  } else {
      echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
