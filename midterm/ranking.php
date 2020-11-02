<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
    $link = mysqli_connect('localhost', 'admin', 'admin', 'youtube');

    if (mysqli_connect_errno()) {
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    $article = '';
    $title = '';

    $query = "SELECT channelTitle, count(video_id) as count, RANK() OVER (ORDER BY count DESC) as rank 
    FROM trendingCount GROUP BY channeltitle 
    ORDER BY count DESC limit 50;";
   
    $result = mysqli_query($link, $query);
        
    $title .= '<tr>';
    $title .= '<th>'.'제목'.'</th>';
    $title .= '<th>'.'채널명'.'</th>';
    $title .= '</tr>';

    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row['rank'];
        $article .= '</td><td>';
        $article .= '<a href="list.php?channelTitle='.$row['channelTitle'].'">'.$row['channelTitle'].'</a>';
        $article .= '</td><td>';
        $article .= $row['count'];
        $article .= '</td></tr>';    
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 가장 많이 트렌딩 된 채널 리스트 </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?after">
    <style>
</style>
    </head>
    <body>
    <div class="logo" style="float:left;">
    <a href="index.php"><img src="./image/youtubelogo.jpg" width="150px" height="80px"></a>
    </div>
    <h2 style="margin-left:-10px;"> 트렌딩 횟수가 가장 많은 채널 TOP50 </h2>
    최근 3개월 간 트렌딩 횟수가 가장 많은 50개의 채널을 보여줍니다. <br><br>
    <table style="margin-left: auto; margin-right: auto; width:0%; border-collapse: separate; padding-left:150px;">
         <tr>
         <th>랭킹</th>
        <th>채널명</th>
        <th>트렌딩 횟수</th>
        </tr>
        <?= $article ?>
    </table>
</body>

</html>