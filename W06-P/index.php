<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> 직원 관리 시스템  </title>
    </head>
    <body>
        <h1>직원 관리 시스템 (수정 버전) </h1>
        <a href="emp_select.php">(1) 직원 정보 조회 </a><br>
        <a href="emp_insert.php">(2) 신규 직원 등록 </a><br>
        <form action = "emp_update.php" method="POST">
        (3) 직원 정보 수정 
        <input type="text" name="emp_no" placeholder="emp_no">
        <input type="submit" value="SEARCH">
        <br>
</form>
<form action = "emp_delete.php" method="POST">
        (4) 직원 정보 삭제
        <input type="text" name="emp_no" placeholder="emp_no">
        <input type="submit" value="DELETE">
        <br>
</form>
    </body>
</html>