<?php
  // var_dump($_POST);
  $link = mysqli_connect("localhost", "root", "rnrn382756", "dbp");

  $filtered = array(
      'title' => mysqli_real_escape_string($link, $_POST['title']),
      'description' => mysqli_real_escape_string($link, $_POST['description']),
      'author_id' => mysqli_real_escape_string($link, $_POST['author_id'])
  );
  $query = "
      INSERT INTO book
          (title, description, author_id)
          VALUES(
              '{$filtered['title']}',
              '{$filtered['description']}',
              '{$filtered['author_id']}'
          )
  ";

  $result = mysqli_query($link, $query);
  if ($result == false) {
      echo '저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      echo mysqli_error($link);
  } else {
      echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
