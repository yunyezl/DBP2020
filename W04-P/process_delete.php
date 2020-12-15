<?php
  // var_dump($_POST);
  $link = mysqli_connect("localhost", "root", "rnrn382756", "dbp");
  settype($_POST['id'], 'int');
  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id']),
  );

  $query = "
    DELETE FROM book WHERE id = '{$filtered['id']}'
  ";

  $result = mysqli_multi_query($link, $query);
  if ($result == false) {
      echo '삭제하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      error_log("errormessagetesttest");
  } else {
      echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
