<?php
    $link = mysqli_connect("localhost", "admin", "admin", "employees");
    // print_r($result);
    // print_r($row)
    // $order = mysqli_real_escape_string($link, $_GET['order']);
    $emp_info = '';
    $title2 = '';
    if(isset($_GET['employeeId_'])){
        $query = "SELECT * FROM employees WHERE emp_no >= {$_GET['employeeId_']} && emp_no <= {$_GET['employeeId_']} + {$_GET['number']}-1 
        ORDER BY emp_no {$_GET['order']}";
        $result = mysqli_query($link, $query);
        $title2 .= '<tr>';
        $title2 .= '<th>'.'emp_no'.'</th>';
        $title2 .= '<th>'.'birth_date'.'</th>';
        $title2 .= '<th>'.'first_name'.'</th>';
        $title2 .= '<th>'.'last_name'.'</th>';
        $title2 .= '<th>'.'gender'.'</th>';
        $title2 .= '<th>'.'hire_date'.'</th>';
        $title2 .= '<th>'.'update'.'</th>';
        $title2 .= '<th>'.'delete'.'</th>';
        $title2 .= '</tr>';
        while( $row = mysqli_fetch_array($result) ){
            $emp_info .= '<tr>';
            $emp_info .= '<td>'.$row['emp_no'].'</td>';
            $emp_info .= '<td>'.$row['birth_date'].'</td>';
            $emp_info .= '<td>'.$row['first_name'].'</td>';
            $emp_info .= '<td>'.$row['last_name'].'</td>';
            $emp_info .= '<td>'.$row['gender'].'</td>';
            $emp_info .= '<td>'.$row['hire_date'].'</td>';
            $emp_info .= '<td><a href="emp_update.php?emp_no='.$row['emp_no'].'">update</a></td>';
            $emp_info .= '<td><a href="emp_delete.php?emp_no='.$row['emp_no'].'">delete</a></td>';
            $emp_info .= '</tr>';
        }
    }
    $emp_info2 = '';
    $title = '';
    if(isset($_GET['employeeId'])) {
        $query2 = "SELECT * FROM employees WHERE emp_no = {$_GET['employeeId']}";
        $result2 = mysqli_query($link, $query2);
        $row2 = mysqli_fetch_array($result2);
        if(mysqli_num_rows($result2) > 0){
            $title .= '<tr>';
            $title .= '<th>'.'emp_no'.'</th>';
            $title .= '<th>'.'birth_date'.'</th>';
            $title .= '<th>'.'first_name'.'</th>';
            $title .= '<th>'.'last_name'.'</th>';
            $title .= '<th>'.'gender'.'</th>';
            $title .= '<th>'.'hire_date'.'</th>';
            $title .= '<th>'.'update'.'</th>';
            $title .= '<th>'.'delete'.'</th>';
            $title .= '</tr>';
            $emp_info2 .= '<tr>';
            $emp_info2 =  '<td>'.$row2['emp_no'].'</td>';
            $emp_info2 .= '<td>'.$row2['birth_date'].'</td>';
            $emp_info2 .= '<td>'.$row2['first_name'].'</td>';
            $emp_info2 .= '<td>'.$row2['last_name'].'</td>';
            $emp_info2 .= '<td>'.$row2['gender'].'</td>';
            $emp_info2 .= '<td>'.$row2['hire_date'].'</td>';
            $emp_info2 .= '<td><a href="emp_update.php?emp_no='.$row2['emp_no'].'">update</a></td>';
            $emp_info2 .= '<td><a href="emp_delete.php?emp_no='.$row2['emp_no'].'">delete</a></td>';
            $emp_info2 .= '</tr>';
        } else {
            $title = "없는 사원번호입니다.";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 직원 관리 시스템 </title>
</head>

<body>
    <h2><a href="index.php">직원 관리 시스템</a> | 직원 정보 조회 (수정 버전)</h2>
    <h3>지정해서 여러개 보기</h3>
    <form action="" method="GET">
        시작 사원번호 <input type="text" name="employeeId_" placeholder="start employeeId"><br>
        몇 개 조회?  <input type="text" name="number" placeholder="number">
    <select name="order">
        <option value="ASC">ASC</option>
        <option value="DESC">DESC</option>
    </select>
        <input type="submit" value="SEARCH"><br>
</form>
    <table border="1">
        <?=$title2?>
        <?=$emp_info?>
    </table>
    <h3> 사원 번호 조회 </h3>
    <form action="" method="GET">
    <input type="text" name="employeeId" placeholder="Search employeeId">
    <input type="submit" value="SEARCH">
    <br>
    <table border="1">
        <?= $title?>
        <?=$emp_info2?>
    </table>
    </form>
</body>

</html>