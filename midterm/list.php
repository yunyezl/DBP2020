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

    $channeltitle = $_GET['channelTitle'];
    $article = '';
    $title = '';

    $query = "SELECT distinct video_id, thumbnail_link, title, channelTitle, channelId, date(trending_date) as trending_date, view_count, likes 
        FROM KR WHERE channelTitle = '{$_GET['channelTitle']}' GROUP BY video_id ORDER BY trending_date, likes DESC";
        
    $result = mysqli_query($link, $query);
        
    $title .= '<tr>';
    $title .= '<th>'.'제목'.'</th>';
    $title .= '<th>'.'채널명'.'</th>';
    $title .= '</tr>';

    while( $row = mysqli_fetch_array($result) ){
        $article .= '<tr><td><a href="https://www.youtube.com/watch?v='.$row['video_id'].'"><img src="https://img.youtube.com/vi/'.$row['video_id'].'/mqdefault.jpg"><a></td><td><h3>';
        $article .= '<a href="https://www.youtube.com/watch?v='.$row['video_id'].'">'.$row['title'].'</a>';
        $article .= '<h3></td><td>';
        $article .= '<a href="https://www.youtube.com/channel/'.$row['channelId'].'">'.$row['channelTitle'].'</a>';
        $article .= '</td><td>';
        $article .= $row['trending_date'];
        $article .= '</td><td>';
        $article .= $row['likes'];
        $article .= '</td><td>';
        $article .= $row['view_count'];
        $article .= '</td></tr>';    
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> <?=$channeltitle?> 의 트렌딩 비디오 리스트  </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?after">
    <style>
</style>
    </head>
    <body>
    <div class="logo" style="float:left;">

    </div>
    <h2> <?=$channeltitle?> 의 트렌딩 비디오 리스트 </h2>
    <table style="margin-left: auto; margin-right: auto; width:0%; border-collapse: separate; padding-left:-200px;">
        <tr>
            <th>미리보기</th>
            <th>제목</th>
            <th>채널명</th>
            <th>트렌딩 날짜</th>
            <th>좋아요</th>
            <th>조회수</th>
        <tr>
        <?= $article ?>
    </table>
</body>

</html>